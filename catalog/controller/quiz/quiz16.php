
<?php
class ControllerQuizQuiz16 extends Controller {
  //тест сравнение
  public function index() {
    if (isset($this->request->get['quiz_id'])) {
      $quiz_id = (int)$this->request->get['quiz_id'];
    } else {
      $this->response->redirect($this->url->link('common/home', '', 'SSL'));
    }
    $this->load->language('information/quiz');
    $this->load->model('catalog/quiz');
    $this->load->model('tool/image');
    $data['breadcrumbs'] = array();
    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('text_home'),
      'href' => $this->url->link('common/home', '', 'SSL')
    );
    //подсасываем скрипт для данного опроса
    $this->document->addScript('catalog/assets/js/znatok_metro.v.1.0.js');

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
    $step_questions = $this->model_catalog_quiz->getSteps($quiz_id);

    shuffle($step_questions);




    $data['step_questions'] = array();
    foreach ($step_questions as $step) {
        $d_qitems = array();
        if (!empty($step['image'])) {
            $image  = $this->model_tool_image->resize($step['image'], 980,350,'w');
          }else{
            $image  = $this->model_tool_image->resize('placeholder.png', 980,350,'h');
          }
        foreach ($step['ar_questions'] as $value) {
          $d_qitems[] = array(
            'question_id'     => $value['question_id'],
            'correct'         => $value['correct'],
            'answer_title'    => $value['answer_title'],
            'answer_comment'  => $value['answer_comment'],
            'sort_order'      => $value['sort_order']
          );
        }
       $data['step_questions'][] = array(
          'qitem_id'     => $step['qitem_id'],
          'title'        => $step['title'],
          'image'        => $image,
          'ar_questions' => $d_qitems
        );
    }

    //подтянем количество проголосавших
    $data['count_people'] =  $this->model_catalog_quiz->getTotalQuizStatsFor($quiz_id);
    //добавим начальный стек
    $data['count_people'] += 3000;

    $data['voices'] = getNumEnding( $data['count_people'],array('человек', 'человека', 'человек'));



   if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quiz/quiz16.tpl')) {
      return $this->load->view($this->config->get('config_template') . '/template/quiz/quiz16.tpl', $data);
    } else {
      return $this->load->view('default/template/quiz/quiz16.tpl', $data);
    }
  }


  public function result(){
    $qshare_id = $this->request->get['qshare_id'];
    //получим инфу об опросе

    $this->load->model('catalog/quiz');
    $this->load->model('tool/image');
    $stat_line_quiz_info  =   $this->model_catalog_quiz->getMyStatsForQuiz($qshare_id);
    $quiz_info            =   $this->model_catalog_quiz->getQuiz($stat_line_quiz_info['quiz_id']);

    //стянем инфу о шаринге и процентах
    $share_info           =   $this->model_catalog_quiz->getQuizShare($stat_line_quiz_info['quiz_id']);
    $value_result = unserialize($stat_line_quiz_info['value']);

    $time = $stat_line_quiz_info['time'];
    $time_tail = $time % 10;

    // print_r('<pre>');
    // print_r($stat_line_quiz_info);
    // print_r('</pre>');
    // die();

    //делаем запрос
    $str_qitems = "'";
    foreach ($value_result as $k => $qitem) {
      $str_qitems = $str_qitems.$k."','";
    }
    $qitems = substr($str_qitems, 0, -2);
    $result_data_answer = $this->model_catalog_quiz->getQuizAnswer($qitems);

    $standard_data_answer = array();
    foreach ($result_data_answer as $qitem_r) {
      if($qitem_r['correct'] == 1){
         $standard_data_answer[$qitem_r['qitem_id']] =  $qitem_r['question_id'];
      }
    }
    $arr_count_yes = 0;
    $count_arr = count($value_result);
    //добавить сравнение
    foreach ($value_result as $k => $result) {
      if($standard_data_answer[$k] == $result){
         $arr_count_yes++;
      }
    }
    //получим процент
    $percent = ($arr_count_yes*100)/$count_arr;

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
    $template_name = 'quiz16_result.tpl';
    if(!empty($this->request->get['uid'])){
      $data['social'] = 'true';
      $template_name = 'quiz_share.tpl';
    }

    //расшариваемое изображение
    // print_r('<pre>');
    // print_r(DIR_IMAGE.$data['share_image']);
    // print_r('</pre>');
    // die();
    $image = new Image(DIR_IMAGE."../".$data['share_image']);
    $new_image = 'result_share/'.$qshare_id.'.jpg';
    $font_size = 64;
    $font_path = DIR_APPLICATION.'/assets/fonts/PFDinDisplay/PFDinDisplay.ttf';
    $x = 50;
    $y = 480;
    
    $image->addText("Я угадал ".$arr_count_yes.($arr_count_yes == 1 ? " станцию" : ($arr_count_yes > 1 && $arr_count_yes < 5 ? " станции" : " станций"))."\nза ".(($time / 60) >= 1 ? round($time / 60, 2)." минут" : $time.($time_tail == 1 && ($time % 100 < 10 || $time % 100 > 20) ? " секунду" :
    ($time_tail > 1 && $time_tail < 5 && ($time % 100 < 10 || $time % 100 > 20) ? " секунды" :
    " секунд"))), $font_size, $x, $y, 'ffffff', $font_path, 0);
    $image->save(DIR_IMAGE . $new_image);

    $data['share_image'] = 'image/' . $new_image;

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
