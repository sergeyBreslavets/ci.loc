<?php
class ControllerRatingTest2 extends Controller {
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
 
    $data['date_begin'] = "2016-02-04T00:00:00Z";
    $data['date_finish']   = date('Y-m-d\TH:i:s\Z',strtotime("-1 day")); 

    if (isset($this->request->get['date_begin']) && isset($this->request->get['date_finish'])) {
      //print_r($this->request->get['date_begin']);
      //print_r(date('Y-m-d\TH:i:s\Z',strtotime($this->request->get['date_begin'])));

    }
   
    $data['action'] = $this->url->link('rating/department');

    $date_start   = $data['date_begin'];
    $date_end     = date('Y-m-d\TH:i:s\Z',strtotime("-1 day")); 
   

    $seconds_diff = strtotime($date_end) - strtotime($data['date_begin']);

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
      $objects = array();
      $objects[] = '3779';
      $objects[] = '3744';
      $objects[] = '3857';
      $objects[] = '3865';
      $objects[] = '3842';
      $objects[] = '3855';
      $objects[] = '3772';
      $objects[] = '3856';
      $objects[] = '3878';
      $objects[] = '3864';
      $objects[] = '3847';
      $objects[] = '3783';
      $objects[] = '3869';
      $objects[] = '3787';
      $objects[] = '3858';
      $objects[] = '3785';
      $objects[] = '3853';
      $objects[] = '3839';
      $objects[] = '3776';
      $objects[] = '3841';
      $objects[] = '3939';
      $objects[] = '3879';
      $objects[] = '3880';
      $objects[] = '3881';
      $objects[] = '3882';
      $objects[] = '3883';
      $objects[] = '3884';
      $objects[] = '3885';
      $objects[] = '3886';
      $objects[] = '3887';

     
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

      print_r('количество дней - '.$count_day);
      print_r('--- исходные данные ---');


      //print_r('<pre>');
    //  print_r($request->body->Indices);
      //print_r('</pre>');
      print_r('<table border=1px>');
      print_r('<tr>');
      print_r('<td>ObjectId</td>');
      print_r('<td>ObjectName</td>');
      print_r('<td>AudienceCount</td>');
      print_r('<td>RepostsAudienceCount</td>');
      print_r('<td>RepostsCount</td>');
      print_r('<td>OtherActionsCount</td>');
      print_r('<td>CommentsCount</td>');
      print_r('<td>Index</td>');
      print_r('<td>CalculatedDate</td>');

      print_r('</tr>');
      foreach ($request->body->Indices as $vr) {
        print_r('<tr>');
        print_r('<td>'.$vr->ObjectId.'</td>');
        print_r('<td>'.$vr->ObjectName.'</td>');
        print_r('<td>'.$vr->AudienceCount.'</td>');
        print_r('<td>'.$vr->RepostsAudienceCount.'</td>');
        print_r('<td>'.$vr->RepostsCount.'</td>');
        print_r('<td>'.$vr->OtherActionsCount.'</td>');
        print_r('<td>'.$vr->CommentsCount.'</td>');
        print_r('<td>'.$vr->Index.'</td>');
        print_r('<td>'.$vr->CalculatedDate.'</td>');
        
        print_r('</tr>');
      }
      print_r('</table>');
      $data['list'] = array();
      $list =array();
      foreach ($request->body->Indices as $vr) {
        $list_index[$vr->ObjectId][] = $vr->Index;
        if(empty($data['list'][$vr->ObjectId])){
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

            'object_total_posts_coverage'   => $data['list'][$vr->ObjectId]['object_total_posts_coverage'] + ($vr->AudienceCount + $vr->RepostsAudienceCount),
            'object_total_social'           => $data['list'][$vr->ObjectId]['object_total_social'] + ($vr->RepostsCount + $vr->OtherActionsCount + $vr->CommentsCount),
            'object_index'                  => $vr->Index
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
         }
         $data['list'][]= array(
            'object_id'                     => $vl['object_id'],
            'object_name'                   => $vl['object_name'],
            'object_description'            => $vl['object_description'],
            'object_total_posts_coverage'   => $vl['object_total_posts_coverage'],
            'object_total_social'           => $vl['object_total_social'],
            'object_index'                  => $obj_index,
            'object_positionChange'         => 0
          );
      }
         usort($data['list'], 'sortByobjIndex');
     
      print_r('Полученный результат');
      print_r('<pre>');
     // print_r($data['list']);
      print_r('</pre>');

      print_r('<table border=1px>');
      print_r('<tr>');
      print_r('<td>ObjectId</td>');
      print_r('<td>ObjectName</td>');
      print_r('<td>object_total_posts_coverage</td>');
      print_r('<td>object_total_social</td>');
      print_r('<td>object_index</td>');
      print_r('</tr>');

      foreach ($data['list'] as $vdl) {
        print_r('<tr>');
        print_r('<td>'.$vdl['object_id'].'</td>');
        print_r('<td>'.$vdl['object_name'].'</td>');
        print_r('<td>'.$vdl['object_total_posts_coverage'].'</td>');
        print_r('<td>'.$vdl['object_total_social'].'</td>');
        print_r('<td>'.$vdl['object_index'].'</td>');

        print_r('</tr>');
      }

      die();
      

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
