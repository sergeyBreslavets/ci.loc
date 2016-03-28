<?php
class ControllerCommonSheader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['img_for_social'] = $this->document->getSocialImg();
		$data['styles'] = $this->document->getStyles();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		$data['name'] = $this->config->get('config_name');

		
		$this->load->language('common/header');

		

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/social_header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/social_header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/social_header.tpl', $data);
		}
	}
}