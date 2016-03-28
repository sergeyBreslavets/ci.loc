
<?php
class ControllerQuizQuiz14 extends Controller {
  public function index() {

    if (isset($this->request->get['quiz_id'])) {
      $quiz_id = (int)$this->request->get['quiz_id'];
    } else {
      $this->response->redirect($this->url->link('common/home', '', 'SSL'));
    }
    $this->load->language('information/quiz');
    $this->load->model('catalog/quiz');
    $data['breadcrumbs'] = array();
    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('text_home'),
      'href' => $this->url->link('common/home', '', 'SSL')
    );
    //подсасываем скрипт для данного опроса
    $this->document->addScript('catalog/assets/js/majorofthecity.v.1.1.js');

   //подтянем инфу о сушности опрос
    $quiz_info = $this->model_catalog_quiz->getQuiz($quiz_id);
    //seo 
    $this->document->setTitle($quiz_info['meta_title']);
    $this->document->setDescription($quiz_info['meta_description']);
    $this->document->setKeywords($quiz_info['meta_keyword']);
    //
    $data['heading_title'] = $quiz_info['title'];
    $data['quiz_id'] = $quiz_id;
    
    $template_name = $quiz_info['template_id'];
    $data['share_rbtn_ya']  = 'rbtn_'.$template_name;


    //получим количество шагов для данного опроса $quiz_id
    $data['step_questions'] = $this->model_catalog_quiz->getSteps($quiz_id);
    //так как тест без картинок то не паримся насчет картинок и сразу отдаем его в шаблон
    shuffle($data['step_questions']);
    

    //подтянем количество проголосавших
    $data['count_people'] =  $this->model_catalog_quiz->getTotalQuizStatsFor($quiz_id);
    //добавим начальный стек
    $data['count_people'] += 3000;

    $data['voices'] = getNumEnding( $data['count_people'],array('человек', 'человека', 'человек'));



   if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quiz/quiz14.tpl')) {
      return $this->load->view($this->config->get('config_template') . '/template/quiz/quiz14.tpl', $data);
    } else {
      return $this->load->view('default/template/quiz/quiz14.tpl', $data);
    }
  }
  public function result(){
    $qshare_id = $this->request->get['qshare_id'];
    //получим инфу об опросе

    $this->load->model('catalog/quiz');
    $stat_line_quiz_info  =   $this->model_catalog_quiz->getMyStatsForQuiz($qshare_id);
    if(empty($stat_line_quiz_info['quiz_id'])){
      $this->response->redirect($this->url->link('common/home', '', 'SSL'));
    }
    $quiz_info            =   $this->model_catalog_quiz->getQuiz($stat_line_quiz_info['quiz_id']);

    //стянем инфу о шаринге и процентах
    $share_info           =   $this->model_catalog_quiz->getQuizShare($stat_line_quiz_info['quiz_id']);
    $value_result = unserialize($stat_line_quiz_info['value']);
   


    //делаем запрос 
    $str_qitems = "'";
    foreach ($value_result as $k => $qitem) {
      $str_qitems = $str_qitems.$k."','";
    }
    $qitems = substr($str_qitems, 0, -2);
    $result_data_answer = $this->model_catalog_quiz->getQuizAnswerWithComment($qitems);
    
    $arr_count_s = 0;
    $arr_count_l = 0;


    $standard_data_answer = array();
    foreach ($result_data_answer as $qitem_r) {
        $standard_data_answer[$qitem_r['qitem_id']][$qitem_r['answer_comment']] =  array(
            'question_id' => $qitem_r['question_id'],
            'correct'     => $qitem_r['correct']
          );
    }
    
    $arr_count_yes = 0;

    $count_arr = count($value_result);
    //добавить сравнение
    foreach ($value_result as $k => $result) {
      if($standard_data_answer[$k]['S']['question_id'] == $result && $standard_data_answer[$k]['S']['correct'] == 1 ){
         $arr_count_s++;
      }
      if($standard_data_answer[$k]['L']['question_id'] == $result && $standard_data_answer[$k]['L']['correct'] == 1 ){
         $arr_count_l++;
      }
    }

    $max_s = 9;
    $max_l = 13;
    //получим проценты для 2 противников
    $percent_s = ($arr_count_s*100)/$max_s;
    $percent_l = ($arr_count_l*100)/$max_l;

    //елси %percent_s
   /* print_r('<pre>');
    print_r($arr_count_s);
    print_r('</pre>');
*/
     
    //получим процент
   
    $percent = (int)$percent_s;

    foreach ( $share_info as $value) {
      if($percent >= $value['percent_start']  && $percent <= $value['percent_end']){
      
        $data['share_image']   = 'image/'.$value['image'];
        $data['share_title']   = $value['quiz_share_description']['share_title'];
        $data['share_text']    = $value['quiz_share_description']['share_comment'];
      }
    }

    $template_id = $quiz_info['template_id'];
    //определим с какой соц сети пришел рефер
    // ok - однокласник
    // fb - facebook
    // tw - twitter
    // vk - vkontakte
    $data['social'] = 'false';
    $template_name = 'quiz14_result.tpl';
    if(!empty($this->request->get['uid'])){
      $data['social'] = 'true';
      $template_name = 'quiz_share.tpl';
    }

    //расшариваемое изображение
   
    //добавим url для шаринга для каждой соцсети
    $template_id = $quiz_info['template_id'];
    $data['share_url_ok'] = $this->url->link('information/quiz/result', 'qshare_id='.$qshare_id.'&uid=ok', 'SSL');
    $data['share_url_vk'] = $this->url->link('information/quiz/result', 'qshare_id='.$qshare_id.'&uid=vk', 'SSL');
    $data['share_url_fb'] = $this->url->link('information/quiz/result', 'qshare_id='.$qshare_id.'&uid=fb', 'SSL');
    $data['share_url_tw'] = $this->url->link('information/quiz/result', 'qshare_id='.$qshare_id.'&uid=tw', 'SSL');
    $data['share_btn_ok']  = 'share_ok_'.$template_id;
    $data['share_btn_vk']  = 'share_vk_'.$template_id;
    $data['share_btn_fb']  = 'share_fb_'.$template_id;
    $data['share_btn_tw']  = 'share_tw_'.$template_id;
    

    //установим теги
    $this->document->setTitle($data['share_title']);
    $this->document->setDescription($data['share_text']);
    $this->document->setSocialImg($data['share_image']);
      
    //если с соц сети то нужен редирект
    $data['redirect'] = str_replace( HTTP_SERVER, '', $this->url->link('information/quiz/view', 'quiz_id='.$stat_line_quiz_info['quiz_id'], 'SSL')) ;;
    $filter_data = array(
      'filter_visibility'    => 1,
      'limit' => 5,
      'start' => 0
    );
    $quizs = $this->model_catalog_quiz->getQuizs($filter_data);
    $data['quizs'] = array();
    foreach ($quizs as $quiz) {
      if($quiz['quiz_id'] != $stat_line_quiz_info['quiz_id']){
        $data['quizs'][] = array(
          'quiz_id'     => $quiz['quiz_id'],
          'status'      => $quiz['status'],
          'quiz_title'  => html_entity_decode($quiz['title']),
          'quiz_href'   => $this->url->link('information/quiz/view', 'quiz_id=' . $quiz['quiz_id'] ),
          'share_id'    => 'btn_'.$quiz['template_id']
        );
      }else{
        $data['quizs'][] = array(
          'status'    => 1,
          'quiz_title'  => 'Поучаствовать в рейтинге',
          'quiz_href'   => $this->url->link('information/raiting', ''),
          'share_id'    => 'btn_independent_rating'
        );
      }
      
    }

    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['column_right'] = $this->load->controller('common/column_right');
    $data['content_top'] = $this->load->controller('common/content_top');
    $data['content_bottom'] = $this->load->controller('common/content_bottom');
    $data['footer'] = $this->load->controller('common/footer');
    $data['social_header']  = $this->load->controller('common/sheader');

    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quiz/'.$template_name)) {
      return $this->load->view($this->config->get('config_template') . '/template/quiz/'.$template_name, $data);
    } else {
      return $this->load->view('default/template/quiz/'.$template_name, $data);
    }
  }
}
  