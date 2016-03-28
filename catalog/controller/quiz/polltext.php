<?php
class ControllerCommonPolltext extends Controller {
  public function index() {
   
   if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quiz/polltext.tpl')) {
      return $this->load->view($this->config->get('config_template') . '/template/quiz/polltext.tpl', $data);
    } else {
      return $this->load->view('default/template/quiz/polltext.tpl', $data);
    }
  }
}