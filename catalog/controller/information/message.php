<?php
class ControllerInformationMessage extends Controller {
  //based on catalog-controller-information-achievement
	private $error = array();

#===============================================================================
	protected function validate() {
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

    if ((utf8_strlen($this->request->post['age']) < 2) || (utf8_strlen($this->request->post['age']) > 16)) {
			$this->error['age'] = $this->language->get('error_age');
		}

		if ((utf8_strlen($this->request->post['message']) < 10) || (utf8_strlen($this->request->post['message']) > 320)) {
			$this->error['message'] = $this->language->get('error_message');
      // $this->error['message'] = utf8_strlen($this->request->post['message']);
		}

		if ($this->config->get('config_google_captcha_status')) {
			$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('config_google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

			$recaptcha = json_decode($recaptcha, true);

			if (!$recaptcha['success']) {
				$this->error['captcha'] = $this->language->get('error_captcha');
			}
		}

		return !$this->error;
	}

#===============================================================================
	public function upload(){
		$json = array();
		$this->language->load('information/message');
		$this->load->model('catalog/message');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			//записываем сообщение
			$write_message = $this->model_catalog_message->addMessage($this->request->post);
			//$this->session->data['success'] = $this->language->get('text_success');

			if ($write_message ) {
				$json['success'] = 1;
			} else {
				$json['error'] = $this->error;
			}
		} else {
			$json['error'] = $this->error;
    }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

#===============================================================================
	public function index(){
		$this->language->load('information/message');
		$this->load->model('catalog/message');
		$data['heading_title'] = $this->language->get('heading_title');
		$detect = new Mobile_Detect();
		// Если не планшет и не мобильное устройство

		//seo
		$this->document->setTitle($data['heading_title']);
		$this->document->setDescription($this->language->get('heading_description'));
		$this->document->setKeywords($this->language->get('heading_keywords'));

    $this->document->addScript('catalog/assets/js/moroz.v.1.0.js');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/message.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/message.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/message.tpl', $data));
		}
	}
}
