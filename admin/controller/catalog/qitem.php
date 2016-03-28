<?php
class ControllerCatalogQitem extends Controller {
  private $error = array();

  public function index() {
    $this->load->language('catalog/qitem');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('catalog/qitem');

    $this->getList();
  }

  public function add() {
    $this->load->language('catalog/qitem');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('catalog/qitem');
    $this->load->model('catalog/quiz');

    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
     /* print_r('<pre>');
      print_r($this->request->post);
      print_r('</pre>');
      die();*/
      $this->model_catalog_qitem->addQitem($this->request->post);

      $this->session->data['success'] = $this->language->get('text_success');

      $url = '';

      if (isset($this->request->get['sort'])) {
        $url .= '&sort=' . $this->request->get['sort'];
      }

      if (isset($this->request->get['order'])) {
        $url .= '&order=' . $this->request->get['order'];
      }

      if (isset($this->request->get['page'])) {
        $url .= '&page=' . $this->request->get['page'];
      }

      $this->response->redirect($this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    }

    $this->getForm();
  }

  public function edit() {
    $this->load->language('catalog/qitem');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('catalog/qitem');

    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
     /* print_r('<pre>');
      print_r($this->request->post);
      print_r('</pre>');
      die();*/
      $this->model_catalog_qitem->editQitem($this->request->get['qitem_id'], $this->request->post);

      $this->session->data['success'] = $this->language->get('text_success');

      $url = '';

      if (isset($this->request->get['sort'])) {
        $url .= '&sort=' . $this->request->get['sort'];
      }

      if (isset($this->request->get['order'])) {
        $url .= '&order=' . $this->request->get['order'];
      }

      if (isset($this->request->get['page'])) {
        $url .= '&page=' . $this->request->get['page'];
      }

      $this->response->redirect($this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    }

    $this->getForm();
  }

  public function delete() {
    $this->load->language('catalog/qitem');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('catalog/qitem');

    if (isset($this->request->post['selected']) && $this->validateDelete()) {
      foreach ($this->request->post['selected'] as $qitem_id) {
        $this->model_catalog_qitem->deleteQitem($qitem_id);
      }

      $this->session->data['success'] = $this->language->get('text_success');

      $url = '';

      if (isset($this->request->get['sort'])) {
        $url .= '&sort=' . $this->request->get['sort'];
      }

      if (isset($this->request->get['order'])) {
        $url .= '&order=' . $this->request->get['order'];
      }

      if (isset($this->request->get['page'])) {
        $url .= '&page=' . $this->request->get['page'];
      }

      $this->response->redirect($this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    }

    $this->getList();
  }

  protected function getList() {
    $data['heading_title']    = $this->language->get('heading_title');
    $data['text_list']        = $this->language->get('text_list');
    $data['text_no_results']  = $this->language->get('text_no_results');
    $data['text_confirm']     = $this->language->get('text_confirm');
    $data['text_enabled']     = $this->language->get('text_enabled');
    $data['text_disabled']    = $this->language->get('text_disabled');
    $data['text_archive']     = $this->language->get('text_archive');
    $data['text_active']      = $this->language->get('text_active');
    $data['text_draft']       = $this->language->get('text_draft');
 
    $data['column_title']     = $this->language->get('column_title');
    $data['column_visibility']    = $this->language->get('column_visibility');
    $data['column_status']    = $this->language->get('column_status');
    $data['column_action']    = $this->language->get('column_action');

    $data['button_add']       = $this->language->get('button_add');
    $data['button_edit']      = $this->language->get('button_edit');
    $data['button_delete']    = $this->language->get('button_delete');
    //дописать подтяжку со статусами
    //******************************************************************/
    $data['ar_status'] = array();
    $data['ar_status'][0] = array(
      'status_id' => 0,
      'title'   => $this->language->get('text_archive')
    );
    $data['ar_status'][1] = array(
      'status_id' => 1,
      'title'   => $this->language->get('text_active')
    );
    $data['ar_status'][2] = array(
      'status_id' => 2,
      'title'   => $this->language->get('text_draft')
    );
    //******************************************************************/
    if (isset($this->request->get['sort'])) {
      $sort = $this->request->get['sort'];
    } else {
      $sort = 'dd.title';
    }

    if (isset($this->request->get['order'])) {
      $order = $this->request->get['order'];
    } else {
      $order = 'ASC';
    }

    if (isset($this->request->get['page'])) {
      $page = $this->request->get['page'];
    } else {
      $page = 1;
    }

    $url = '';

    if (isset($this->request->get['sort'])) {
      $url .= '&sort=' . $this->request->get['sort'];
    }

    if (isset($this->request->get['order'])) {
      $url .= '&order=' . $this->request->get['order'];
    }

    if (isset($this->request->get['page'])) {
      $url .= '&page=' . $this->request->get['page'];
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('text_home'),
      'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
    );

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('heading_title'),
      'href' => $this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . $url, 'SSL')
    );

    $data['add'] = $this->url->link('catalog/qitem/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
    $data['delete'] = $this->url->link('catalog/qitem/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    // -- получим список опросов -- //
     $this->load->model('catalog/quiz');
    // -- наверно все таки всех -- //
    $filter_data_for_qiuz = array(
      'filter_status' => 1,
    );

    $quiz_results         = $this->model_catalog_quiz->getQuizs($filter_data_for_qiuz);
    $data['quiz_results'] = array();
    foreach ($quiz_results as $quiz_result) {
      $data['quiz_results'][$quiz_result['quiz_id']] = array(
        'quiz_id'     => $quiz_result['quiz_id'],
        'quiz_title'  => $quiz_result['title']
      );
    }

    $data['qitems'] = array();

    $filter_data = array(
      'sort'  => $sort,
      'order' => $order,
      'start' => ($page - 1) * $this->config->get('config_limit_admin'),
      'limit' => $this->config->get('config_limit_admin')
    );

    $qitem_total = $this->model_catalog_qitem->getTotalQitems();

    $results = $this->model_catalog_qitem->getQitems($filter_data);

    foreach ($results as $result) {
      $data['qitems'][] = array(
        'qitem_id'      => $result['qitem_id'],
        'title'         => $result['title'],
        'quiz_title'    => $data['quiz_results'][$result['quiz_id']]['quiz_title'],
        'visibility'    => ($result['visibility'])?$this->language->get('text_enabled'):$this->language->get('text_disabled'),
        'status'        => $data['ar_status'][$result['status']]['title'],
        'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
        'edit'          => $this->url->link('catalog/qitem/edit', 'token=' . $this->session->data['token'] . '&qitem_id=' . $result['qitem_id'] . $url, 'SSL')
      );
    }

   
    if (isset($this->error['warning'])) {
      $data['error_warning'] = $this->error['warning'];
    } else {
      $data['error_warning'] = '';
    }

    if (isset($this->session->data['success'])) {
      $data['success'] = $this->session->data['success'];

      unset($this->session->data['success']);
    } else {
      $data['success'] = '';
    }

    if (isset($this->request->post['selected'])) {
      $data['selected'] = (array)$this->request->post['selected'];
    } else {
      $data['selected'] = array();
    }

    $url = '';

    if ($order == 'ASC') {
      $url .= '&order=DESC';
    } else {
      $url .= '&order=ASC';
    }

    if (isset($this->request->get['page'])) {
      $url .= '&page=' . $this->request->get['page'];
    }

    $data['sort_title']       = $this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . '&sort=dd.title' . $url, 'SSL');
    $data['sort_visibility']  = $this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . '&sort=d.visibility' . $url, 'SSL');
    $data['sort_date_added']  = $this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . '&sort=d.date_added' . $url, 'SSL');

    $url = '';

    if (isset($this->request->get['sort'])) {
      $url .= '&sort=' . $this->request->get['sort'];
    }

    if (isset($this->request->get['order'])) {
      $url .= '&order=' . $this->request->get['order'];
    }

    $pagination = new Pagination();
    $pagination->total = $qitem_total;
    $pagination->page = $page;
    $pagination->limit = $this->config->get('config_limit_admin');
    $pagination->url = $this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

    $data['pagination'] = $pagination->render();

    $data['results'] = sprintf($this->language->get('text_pagination'), ($qitem_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($qitem_total - $this->config->get('config_limit_admin'))) ? $qitem_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $qitem_total, ceil($qitem_total / $this->config->get('config_limit_admin')));

    $data['sort'] = $sort;
    $data['order'] = $order;

    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('catalog/qitem/qitem_list.tpl', $data));
  }



/*********** form **************/
  protected function getForm() {
    $data['heading_title'] = $this->language->get('heading_title');

    $data['text_form'] = !isset($this->request->get['qitem_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
    
    $data['text_default'] = $this->language->get('text_default');
    $data['text_enabled'] = $this->language->get('text_enabled');
    $data['text_disabled'] = $this->language->get('text_disabled');

    $data['text_image_manager'] = $this->language->get('text_image_manager');
    $data['text_browse'] = $this->language->get('text_browse');
    $data['text_clear'] = $this->language->get('text_clear'); 

    $data['text_image'] = $this->language->get('text_image');
    $data['text_browse'] = $this->language->get('text_browse');
    $data['text_clear'] = $this->language->get('text_clear');
    $data['text_image_manager'] = $this->language->get('text_image_manager');


    $data['text_archive'] = $this->language->get('text_archive');
    $data['text_active'] = $this->language->get('text_active');
    $data['text_draft'] = $this->language->get('text_draft');
    $data['text_none'] = $this->language->get('text_none');

    $data['entry_title'] = $this->language->get('entry_title');
    $data['entry_address'] = $this->language->get('entry_address');
    $data['entry_description'] = $this->language->get('entry_description');
    $data['entry_meta_title'] = $this->language->get('entry_meta_title');
    $data['entry_meta_description'] = $this->language->get('entry_meta_description');
    $data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
    $data['entry_keyword'] = $this->language->get('entry_keyword');
    $data['entry_qitem_date_begin'] = $this->language->get('entry_qitem_date_begin');
    $data['entry_qitem_date_end'] = $this->language->get('entry_qitem_date_end');
    $data['entry_status'] = $this->language->get('entry_status');
    $data['entry_visibility'] = $this->language->get('entry_visibility');
    $data['entry_quiz'] = $this->language->get('entry_quiz');
    $data['entry_latitude_longitude'] = $this->language->get('entry_latitude_longitude');
    
    $data['entry_image_title'] = $this->language->get('entry_image_title');
    $data['entry_link'] = $this->language->get('entry_link');
    $data['entry_image'] = $this->language->get('entry_image');
    $data['entry_sort_order'] = $this->language->get('entry_sort_order');

    $data['entry_question_title'] = $this->language->get('entry_question_title');
    $data['entry_sort_order'] = $this->language->get('entry_sort_order');



    $data['button_save'] = $this->language->get('button_save');
    $data['button_cancel'] = $this->language->get('button_cancel');
    $data['button_add'] = $this->language->get('button_add');
    $data['button_image_add'] = $this->language->get('button_image_add');
    $data['button_remove'] = $this->language->get('button_remove');

    $data['tab_general'] = $this->language->get('tab_general');
    $data['tab_data'] = $this->language->get('tab_data');
    $data['tab_image'] = $this->language->get('tab_image');
    $data['tab_question'] = $this->language->get('tab_question');


    if (isset($this->error['warning'])) {
      $data['error_warning'] = $this->error['warning'];
    } else {
      $data['error_warning'] = '';
    }

    if (isset($this->error['title'])) {
      $data['error_title'] = $this->error['title'];
    } else {
      $data['error_title'] = array();
    }

    if (isset($this->error['description'])) {
      $data['error_description'] = $this->error['description'];
    } else {
      $data['error_description'] = array();
    }

    if (isset($this->error['meta_title'])) {
      $data['error_meta_title'] = $this->error['meta_title'];
    } else {
      $data['error_meta_title'] = array();
    }

    if (isset($this->error['keyword'])) {
      $data['error_keyword'] = $this->error['keyword'];
    } else {
      $data['error_keyword'] = '';
    }

    if (isset($this->error['qitem_image'])) {
      $data['error_qitem_image'] = $this->error['qitem_image'];
    } else {
      $data['error_qitem_image'] = array();
    }
    
    $url = '';

    if (isset($this->request->get['sort'])) {
      $url .= '&sort=' . $this->request->get['sort'];
    }

    if (isset($this->request->get['order'])) {
      $url .= '&order=' . $this->request->get['order'];
    }

    if (isset($this->request->get['page'])) {
      $url .= '&page=' . $this->request->get['page'];
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('text_home'),
      'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
    );

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('heading_title'),
      'href' => $this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . $url, 'SSL')
    );

    if (!isset($this->request->get['qitem_id'])) {
      $data['action'] = $this->url->link('catalog/qitem/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
    } else {
      $data['action'] = $this->url->link('catalog/qitem/edit', 'token=' . $this->session->data['token'] . '&qitem_id=' . $this->request->get['qitem_id'] . $url, 'SSL');
    }

    $data['cancel'] = $this->url->link('catalog/qitem', 'token=' . $this->session->data['token'] . $url, 'SSL');

    $this->load->model('localisation/language');

    $data['languages'] = $this->model_localisation_language->getLanguages();

    if (isset($this->request->get['qitem_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $qitem_info = $this->model_catalog_qitem->getQitem($this->request->get['qitem_id']);
    }

    $data['token'] = $this->session->data['token'];

    if (isset($this->request->get['qitem_id'])) {
      $data['qitem_id'] = $this->request->get['qitem_id'];
    } else {
      $data['qitem_id'] = 0;
    }

    if (isset($this->request->post['qitem_description'])) {
      $data['qitem_description'] = $this->request->post['qitem_description'];
    } elseif (isset($this->request->get['qitem_id'])) {
      $data['qitem_description'] = $this->model_catalog_qitem->getQitemDescriptions($this->request->get['qitem_id']);
    } else {
      $data['qitem_description'] = array();
    }

    if (isset($this->request->post['keyword'])) {
      $data['keyword'] = $this->request->post['keyword'];
    } elseif (!empty($place_info)) {
      $data['keyword'] = $place_info['keyword'];
    } else {
      $data['keyword'] = '';
    }

    // -- получим список опросов -- //
     $this->load->model('catalog/quiz');
    // -- наверно все таки всех -- //
    $filter_data_for_qiuz = array(
      'filter_status' => 1,
    );

    $quiz_results         = $this->model_catalog_quiz->getQuizs($filter_data_for_qiuz);
    $data['quiz_results'] = array();
    foreach ($quiz_results as $quiz_result) {
      $data['quiz_results'][] = array(
        'quiz_id'   => $quiz_result['quiz_id'],
        'quiz_title' => $quiz_result['title']
      );
    }
    
    if (isset($this->request->post['quiz_id'])) {
      $data['quiz_id'] = $this->request->post['quiz_id'];
    } elseif (!empty($qitem_info)) {
      $data['quiz_id'] = $qitem_info['quiz_id'];
    } else {
      $data['quiz_id'] = '';
    }

    if (isset($this->request->post['sort_order'])) {
      $data['sort_order'] = $this->request->post['sort_order'];
    } elseif (!empty($qitem_info)) {
      $data['sort_order'] = $qitem_info['sort_order'];
    } else {
      $data['sort_order'] = '';
    }
    
    //дописать подтяжку со статусами
//******************************************************************/
    $data['ar_status'] = array();
    $data['ar_status'][] = array(
      'status_id' => 0,
      'title'   => $this->language->get('text_archive')
    );
    $data['ar_status'][] = array(
      'status_id' => 1,
      'title'   => $this->language->get('text_active')
    );
    $data['ar_status'][] = array(
      'status_id' => 2,
      'title'   => $this->language->get('text_draft')
    );
//******************************************************************/
    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } elseif (!empty($qitem_info)) {
      $data['status'] = $qitem_info['status'];
    } else {
      $data['status'] = 1;
    }

    if (isset($this->request->post['visibility'])) {
      $data['visibility'] = $this->request->post['visibility'];
    } elseif (!empty($qitem_info)) {
      $data['visibility'] = $qitem_info['visibility'];
    } else {
      $data['visibility'] = 1;
    }

    $this->load->model('tool/image');

    if (isset($this->request->post['image'])) {
      $data['image'] = $this->request->post['image'];
    } elseif (!empty($qitem_info['image'])) {
      $data['image'] = $qitem_info['image'];
    } else {
      $data['image'] = '';
    }
    
    if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100,'h');
    } elseif (!empty($qitem_info['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($qitem_info['image'], 100, 100,'h');
    } else {
      $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100,'h');
    }
    
    $data['no_image'] = $this->model_tool_image->resize('no_image.png', 100, 100,'h');
//********************* list-view-qitem **********************/ 

    if (isset($this->request->post['qitem_image'])) {
      $qitem_images = $this->request->post['qitem_image'];
    } elseif (isset($this->request->get['qitem_id'])) {
      $qitem_images = $this->model_catalog_qitem->getQitemImages($this->request->get['qitem_id']);
    } else {
      $qitem_images = array();
    }

    $data['qitem_images'] = array();

    foreach ($qitem_images as $qitem_image) {
      if (is_file(DIR_IMAGE . $qitem_image['image'])) {
        $image = $qitem_image['image'];
        $thumb = $qitem_image['image'];
      } else {
        $image = '';
        $thumb = 'no_image.png';
      }

      $data['qitem_images'][] = array(
        'qitem_image_description' => $qitem_image['qitem_image_description'],
        'link'                     => $qitem_image['link'],
        'image'                    => $image,
        'thumb'                    => $this->model_tool_image->resize($thumb, 100, 100,'h'),
        'sort_order'               => $qitem_image['sort_order']
      );
    }


    $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100,'h');
//********************* /.list-view-qitem **********************/ 

    $data['qitem_questions'] = array();

    if (isset($this->request->post['qitem_question'])) {
      $qitem_questions = $this->request->post['qitem_question'];
    } elseif (isset($this->request->get['qitem_id'])) {
      $qitem_questions = $this->model_catalog_qitem->getQitemQuestions($this->request->get['qitem_id']);
    } else {
      $qitem_questions = array();
    }


    foreach ($qitem_questions as $qitem_question) {
      if (is_file(DIR_IMAGE . $qitem_question['image'])) {
        $image = $qitem_question['image'];
        $thumb = $qitem_question['image'];
      } else {
        $image = '';
        $thumb = 'no_image.png';
      }

      $data['qitem_questions'][] = array(
        'qitem_question_description' => $qitem_question['qitem_question_description'],
        'question_id'               => $qitem_question['question_id'],
        'correct'                    => $qitem_question['correct'],
        'image'                    => $image,
        'thumb'                    => $this->model_tool_image->resize($thumb, 100, 100,'h'),
        'sort_order'               => $qitem_question['sort_order']
      );
    }



    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('catalog/qitem/qitem_form.tpl', $data));
  }

  protected function validateForm() {

    if (!$this->user->hasPermission('modify', 'catalog/qitem')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    foreach ($this->request->post['qitem_description'] as $language_id => $value) {
      if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 255)) {
        $this->error['title'][$language_id] = $this->language->get('error_title');
      }

      if (utf8_strlen($value['description']) < 3) {
      //  $this->error['description'][$language_id] = $this->language->get('error_description');
      }

      if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
      //  $this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
      }
    }

    if (utf8_strlen($this->request->post['keyword']) > 0) {
      $this->load->model('catalog/url_alias');

      $url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

      if ($url_alias_info && isset($this->request->get['qitem_id']) && $url_alias_info['query'] != 'qitem_id=' . $this->request->get['qitem_id']) {
        $this->error['keyword'] = sprintf($this->language->get('error_keyword'));
      }

      if ($url_alias_info && !isset($this->request->get['qitem_id'])) {
        $this->error['keyword'] = sprintf($this->language->get('error_keyword'));
      }
    }

    if (isset($this->request->post['qitem_image'])) {
      foreach ($this->request->post['qitem_image'] as $qitem_image_id => $qitem_image) {
        foreach ($qitem_image['qitem_image_description'] as $language_id => $qitem_image_description) {
          if ((utf8_strlen($qitem_image_description['title']) < 2) || (utf8_strlen($qitem_image_description['title']) >255)) {
            $this->error['qitem_image'][$qitem_image_id][$language_id] = $this->language->get('error_image_title'); 
          }         
        }
      } 
    }

    
    return !$this->error;
  }

  protected function validateDelete() {
    if (!$this->user->hasPermission('modify', 'catalog/qitem')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    

    return !$this->error;
  }

  
}