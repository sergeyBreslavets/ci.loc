<?php
class ControllerRatingDepartment extends Controller {
  private $error = array();
  public function index() {
    //загрузим язык
    $this->load->language('rating/department ');
    


    $data['heading_title'] = $this->config->get('config_meta_title');
    //seo
    $this->document->setTitle($data['heading_title']);
    $this->document->setDescription($this->language->get('config_meta_description'));
    $this->document->setKeywords($this->language->get('config_meta_keywords'));

    if (isset($this->request->get['route'])) {
      $this->document->addLink(HTTP_SERVER, 'canonical');
    }
    date_default_timezone_set('UTC');
   
    

     //начальная дата 4 февраля 2016
 
    $data['date_begin'] = "2016-02-22T00:00:00Z";
    $data['date_finish']   = date('Y-m-d\TH:i:s\Z',strtotime("-1 day")); 

    if (isset($this->request->get['date_begin']) && isset($this->request->get['date_finish'])) {
      //print_r($this->request->get['date_begin']);
      //print_r(date('Y-m-d\TH:i:s\Z',strtotime($this->request->get['date_begin'])));

    }
   
    $data['action'] = $this->url->link('rating/department');

    $date_start   = "2016-02-22T00:00:00Z";
    $date_end     = "2016-02-29T00:00:00Z"; //date('Y-m-d\TH:i:s\Z',strtotime("-1 day")); 
   

    $seconds_diff = strtotime($date_end) - strtotime($date_start);

    $count_day = floor($seconds_diff/3600/24); //-1 добавили минус текущий день


    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

    }


    //список обьектов
    //  $url_get_list = "http://api.mindscan.ru:10088/data/api/v0.9/index/getobjectstoindex";

      //$response = \Httpful\Request::get($url_get_list)
        //  ->expectsJson()
        //  ->send();
       //
      
      $objects = array();
      //foreach ($response->body as $value) {
       // $objects[]= $value->ObjectId;
      //}
      $objects[] = '3757';
      $objects[] = '3821';
      $objects[] = '3810';
      $objects[] = '3816';
      $objects[] = '3795';
      $objects[] = '3808';
      $objects[] = '3771';
      $objects[] = '3809';
      $objects[] = '3802';
      $objects[] = '3815';
      $objects[] = '3801';
      $objects[] = '3782';
      $objects[] = '3820';
      $objects[] = '3786';
      $objects[] = '3811';
      $objects[] = '3784';
      $objects[] = '3799';
      $objects[] = '3792';
      $objects[] = '3775';
      $objects[] = '3794';
      $objects[] = '3749';
      $objects[] = '3831';
      $objects[] = '3830';
      $objects[] = '3828';
      $objects[] = '3829';
      $objects[] = '3832';
      $objects[] = '3833';
      $objects[] = '3834';
      $objects[] = '3836';
      $objects[] = '3837';

     
      $count_objects = count($objects); //количестов обектов


      $pagesize = $count_day*$count_objects;


      $data_response = array(
        'ObjectsIds'=>$objects,
        "StartDate"=>$date_start,
        "EndDate"=>$date_end,
        "PageSize"=>$pagesize,
        "PageNumber"=>0
      );

      $url_post_list = "http://api.mindscan.ru:10088/data/api/v0.9/index/getobjectsindices/";
      $request = \Httpful\Request::post($url_post_list)->sendsJson()->body($data_response)->send();
/*
      print_r('количество дней - '.$count_day);
      print_r('<pre>');
      print_r($request->body->Indices);
      print_r('</pre>');
     */ 
    
      $data['list'] = array();
      $list = array();
      foreach ($request->body->Indices as $vr) {
        $list_index[$vr->ObjectId][] = $vr->Index;

        if(empty($list[$vr->ObjectId])){
          
          $list[$vr->ObjectId]= array(
            'object_id'                     => $vr->ObjectId,
            'object_name'                   => $vr->ObjectName,
            'object_description'            => $vr->ObjectDescription,
            'object_total_posts_coverage'   => ($vr->AudienceCount + $vr->RepostsAudienceCount),
            'object_total_social'           => $vr->RepostsCount + $vr->OtherActionsCount + $vr->CommentsCount,
            'object_index'                  => $vr->Index
          );

        }else{
          $list[$vr->ObjectId]= array(
            'object_id'                     => $vr->ObjectId,
            'object_name'                   => $vr->ObjectName,
            'object_description'            => $vr->ObjectDescription,

            'object_total_posts_coverage'   => $list[$vr->ObjectId]['object_total_posts_coverage'] + ($vr->AudienceCount + $vr->RepostsAudienceCount),
            'object_total_social'           => $list[$vr->ObjectId]['object_total_social'] + ($vr->RepostsCount + $vr->OtherActionsCount + $vr->CommentsCount),
            'object_index'                  => $list[$vr->ObjectId]['object_index'] + $vr->Index
          );
        }
      }

      foreach ($list as $key => $vl) {
          //получим средний индекс для текущего обьектка
         $obj_index = 0;
         if(!empty($list_index[$key])){
          $sum_indices = 0;
          foreach ($list_index[$key] as $vli) {
            $sum_indices += $vli;
          }
          $obj_index = $sum_indices/$count_day;
      /*   
          print_r('<pre>');
          print_r($vl['object_id']);
          print_r('</pre>');

          print_r('<pre>');
          print_r($sum_indices);
          print_r('</pre>');


          print_r('<pre>');
          print_r($obj_index);
          print_r('</pre>');

          print_r('-----------------------------');
*/
         }
         $data['list'][]= array(
            'object_id'                     => $vl['object_id'],
            'object_name'                   => $vl['object_name'],
            'object_description'            => $vl['object_description'],
            'object_total_posts_coverage'   => $vl['object_total_posts_coverage'],
            'object_total_social'           => $vl['object_total_social'],
            'object_index'                  => number_format($obj_index, 2, '.', ''),
            'object_positionChange'         => 0
          );
      }

      
         usort($data['list'], 'sortByobjIndex');
     
   

      

    $data['column_left'] = $this->load->controller('common/column_left');
    $data['column_right'] = $this->load->controller('common/column_right');
    $data['content_top'] = $this->load->controller('common/content_top');
    $data['content_bottom'] = $this->load->controller('common/content_bottom');
    $data['footer'] = $this->load->controller('common/footer');
    $data['header'] = $this->load->controller('common/header');

    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/rating/department.tpl')) {
      $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/rating/department.tpl', $data));
    } else {
      $this->response->setOutput($this->load->view('default/template/rating/department.tpl', $data));
    }
  }
  protected function validate() {
    if (!isset($this->request->post['email'])) {
     // $this->error['warning'] = $this->language->get('error_email');
    }
    return !$this->error;
  }
}
