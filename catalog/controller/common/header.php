<?php
class ControllerCommonHeader extends Controller {
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
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		$detect = new Mobile_Detect();
		
		$data['mobile'] = 'false';//'false';
		$data['tablet'] = 'false';//'false';
		if( $detect->isMobile() &&  !$detect->isTablet()){
			$data['mobile'] = 'true';
		}
		if($detect->isTablet()){
			$data['tablet'] = 'true';
		}
		
		$data['home'] = $this->url->link('common/home');;
		if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		//рейтинг
		$this->load->model('catalog/raiting');
		$this->load->model('catalog/achievement');
		//получим обшее количесвто реальных проголосовавших человек
		$raitings_stat = $this->model_catalog_raiting->getCountForRaiting();
		$data['count_voices'] = 0;
		$i=0;
		foreach ($raitings_stat as $value) {
			$data['count_voices'] += $value['total'];
		};
		//подсчитаем ачивки
		$filter_data = array(
			'filter_status'    => 1
		);

		$raitings_stat = $this->model_catalog_raiting->getCountForRaiting();
		$data['stats'] = array();
		foreach ($raitings_stat as $value) {
			$data['count_voices'] += $value['total'];
		};

		//получим колочиесво прощедщих опрос
		$this->load->model('catalog/quiz');
	
		$count_quiz = $this->model_catalog_quiz->getTotalQuizStats();
		///!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		$data['count_voices'] +=  ($count_quiz+9000);
		$data['count_voices'] = (int)$data['count_voices'];
		$data['t_voices'] = getNumEnding($data['count_voices'],array('человек', 'человека', 'человек'));

		

		$data['add_achievement'] = $this->url->link('information/achievement', '', 'SSL');

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

	

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
}