<?php
class ControllerInformationRaiting extends Controller {
	private $error = array();
	public function in(){
		/*
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "raiting_stats WHERE raiting_id = 3 ORDER BY  stat_id LIMIT 60000");

		$data =  $query->rows;

		$ser_data = array();
		foreach ($data as $value) {
				$ser_data[ $value['rshare_id'] ]['value'][ ] = $value['achievement_id'] ;
				$ser_data[ $value['rshare_id'] ]['rshare_id'] = $value['rshare_id'];
				$ser_data[ $value['rshare_id'] ]['raiting_id'] = $value['raiting_id'].'0';
				$ser_data[ $value['rshare_id'] ]['ip'] = $value['ip'];
				$ser_data[ $value['rshare_id'] ]['date_added'] = $value['date_added'];
				$ser_data[ $value['rshare_id'] ]['customer_id'] = $value['customer_id'];
		}

		foreach ($ser_data as $val) {
			print_r('<pre>');
			print_r("DELETE FROM " . DB_PREFIX . "raiting_stats WHERE rshare_id = '" . $val['rshare_id'] . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "raiting_stats WHERE rshare_id = '" . $val['rshare_id'] . "'");
			print_r('</pre>');

			print_r('<pre>');
			print_r("INSERT INTO " . DB_PREFIX . "raiting_stats SET rshare_id = '" .  $this->db->escape($val['rshare_id']) . "', customer_id = '" . (int)$val['customer_id'] . "', raiting_id = '" . (int)$val['raiting_id'] . "', value = '" .  $this->db->escape(serialize($val['value']) )  . "', ip = '" . $this->db->escape($val['ip']) . "',date_added ='" . $this->db->escape($val['date_added']) . "' ");
			$this->db->query("INSERT INTO " . DB_PREFIX . "raiting_stats SET
				rshare_id = '" .  $this->db->escape($val['rshare_id']) . "',
				customer_id = '" . (int)$val['customer_id'] . "',
				raiting_id = '" . (int)$val['raiting_id'] . "',
				value = '" .  $this->db->escape(serialize($val['value']) )  . "',
				ip = '" . $this->db->escape($val['ip']) . "',
				date_added ='" . $this->db->escape($val['date_added']) . "'
			");

			print_r('</pre>');
		}
		print_r( count($ser_data) );


		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=3 WHERE raiting_id = '30'");
		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=4 WHERE raiting_id = '40'");
		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=5 WHERE raiting_id = '50'");
		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=6 WHERE raiting_id = '60'");
		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=7 WHERE raiting_id = '70'");
		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=8 WHERE raiting_id = '80'");
		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=9 WHERE raiting_id = '90'");
		$this->db->query("UPDATE  " . DB_PREFIX . "raiting_stats SET  `raiting_id`=10 WHERE raiting_id = '100'");
		print_r('expression');
		die();
		*/
	}

	public function index() {
		$this->language->load('information/raiting');
		$this->load->model('tool/image');
		$this->load->model('catalog/raiting');
		$this->load->model('catalog/achievement');
		$data['heading_title'] = $this->language->get('heading_title');
		$detect = new Mobile_Detect();
		// Если не планшет и не мобильное устройство
		//seo
		$this->document->setTitle($data['heading_title']);
		$this->document->setDescription($this->language->get('heading_description'));
		$this->document->setKeywords($this->language->get('heading_keywords'));


		//получим обшее количесвто реальных проголосовавших человек
		$raitings_stat = $this->model_catalog_raiting->getCountForRaiting();
		$data['stats'] = array();
		$i=0;
		foreach ($raitings_stat as $value) {
			$data['stats'][$value['raiting_id']] = array(
				'voice' => ($value['total'])/5
			);
			$i++;
		};
		//получим список аветивных рейтингов
		$filter_data = array(
			'filter_status'    => 1,
			'filter_visibility'    => 0
		);

		$raitings_top = $this->model_catalog_raiting->getRaitings($filter_data);
		$data['raitings_top'] = array();
		foreach ($raitings_top as $raiting) {

			if (!empty($raiting['image'])) {
				if( !$detect->isMobile() && !$detect->isTablet() ){
					$image = $this->model_tool_image->resize($raiting['image'], 1920,1080,'h');
				}else{
					$image = $this->model_tool_image->resize($raiting['image'], 1024,768,'h');
				}
			}else{
				$image 		= $this->model_tool_image->resize('placeholder.png', 1024,768,'h');
			}


			//получим количестов нулевых значений из таблицы achiev
			$total_zero_voice_for_current_raiting = $this->model_catalog_achievement -> getZeroVoices($raiting['raiting_id']);
			$count_voice_for_current_raiting = 0;
			foreach ($total_zero_voice_for_current_raiting as  $value) {
				$count_voice_for_current_raiting += $value['score_id'];
			}

			//добавим нулевые стоки
			if(!empty($data['stats'][$raiting['raiting_id']]['voice'])){
				$voices = $data['stats'][$raiting['raiting_id']]['voice'] + (int)($count_voice_for_current_raiting/10);
			}else{
				$voices = (int)($count_voice_for_current_raiting/10);
			}
			if (!$this->request->server['HTTPS']) {
				$share_btn_ya = str_replace(HTTP_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']), $count);
			} else {
				$share_btn_ya = str_replace(HTTPS_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']), $count);
			}
			$data['raitings_top'][] = array(
				'raiting_id' 			=> $raiting['raiting_id'],
				'raiting_title' 		=> $raiting['title'],
				'raiting_voice' 		=> sprintf($this->language->get('text_raiting_voice'), $voices, getNumEnding( $voices,array('человек', 'человека', 'человек'))),
				'raiting_image' 		=> $image,
				'raiting_href' 	 		=> $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']),
				'share_btn_ya'				=> 'btn_'.$share_btn_ya
			);
		}



		//получим список аветивных рейтингов
		$filter_data = array(
			'filter_status'    => 1,
			'filter_visibility'    => 1
		);
		$raitings = $this->model_catalog_raiting->getRaitings($filter_data);
		$data['raitings'] = array();
		foreach ($raitings as $raiting) {

			if (!empty($raiting['image'])) {
				if( !$detect->isMobile() && !$detect->isTablet() ){
					$image = $this->model_tool_image->resize($raiting['image'], 1920,1080,'h');
				}else{
					$image = $this->model_tool_image->resize($raiting['image'], 1024,768,'h');
				}
			}else{
				$image 		= $this->model_tool_image->resize('placeholder.png', 1024,768,'h');
			}


			//получим количестов нулевых значений из таблицы achiev
			$total_zero_voice_for_current_raiting = $this->model_catalog_achievement -> getZeroVoices($raiting['raiting_id']);
			$count_voice_for_current_raiting = 0;
			foreach ($total_zero_voice_for_current_raiting as  $value) {
				$count_voice_for_current_raiting += $value['score_id'];
			}

			//добавим нулевые стоки
			if(!empty($data['stats'][$raiting['raiting_id']]['voice'])){
				$voices = $data['stats'][$raiting['raiting_id']]['voice'] + (int)($count_voice_for_current_raiting/10);
			}else{
				$voices = (int)($count_voice_for_current_raiting/10);
			}
			if (!$this->request->server['HTTPS']) {
				$share_btn_ya = str_replace(HTTP_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']), $count);
			} else {
				$share_btn_ya = str_replace(HTTPS_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']), $count);
			}
			$data['raitings'][] = array(
				'raiting_id' 			=> $raiting['raiting_id'],
				'raiting_title' 		=> $raiting['title'],
				'raiting_voice' 		=> sprintf($this->language->get('text_raiting_voice'), $voices, getNumEnding( $voices,array('человек', 'человека', 'человек'))),
				'raiting_image' 		=> $image,
				'raiting_href' 	 		=> $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']),
				'share_btn_ya'				=> 'btn_'.$share_btn_ya
			);
		}
		shuffle($data['raitings']);
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/raiting/raitings_list.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/raiting/raitings_list.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/raiting/raitings_list.tpl', $data));
		}

	}

	public function topresult() {
		$this->language->load('information/raiting');
		$this->load->model('tool/image');
		$this->load->model('catalog/raiting');
		$this->load->model('catalog/achievement');
		$data['heading_title'] = $this->language->get('heading_title');
		$detect = new Mobile_Detect();
		// Если не планшет и не мобильное устройство
		//seo
		$this->document->setTitle($data['heading_title']);
		$this->document->setDescription($this->language->get('heading_description'));
		$this->document->setKeywords($this->language->get('heading_keywords'));
		$filter_data = array(
			'filter_status'    => 1
		);

		$achievements = $this->model_catalog_achievement->getAchievements($filter_data);
		$data['achievements'] = array();
		foreach ($achievements as $achievement) {
			if (!empty($achievement['image'])) {
				$image = $this->model_tool_image->resize($achievement['image'], 243,213,'h');
			}else{
				$image = $this->model_tool_image->resize('placeholder.png', 243,213,'h');
			}
			$data['achievements'][$achievement['achievement_id']] = array(
				'achievement_id' 			=> $achievement['achievement_id'],
				'achievement_title' 		=> $achievement['title'],
				'achievement_image' 		=> $image,
				'score_id'					=> $achievement['score_id']
			);
		}

		//получим список аветивных рейтингов
		$filter_data = array(
			'filter_status'    => 1
		);
		$raitings = $this->model_catalog_raiting->getRaitings($filter_data);
		$data['raitings'] = array();
		foreach ($raitings as $raiting) {
			//подтянем статистику
			$filter_data = array();
			$top_raitng = array();
			$raiting_stat =  $this->model_catalog_raiting->getStatsForRaiting($raiting['raiting_id'],$filter_data);
			$final_achievements = array();
			foreach ($raiting_stat as $rs) {
				//раскрываем список
				$unserial_data = unserialize($rs['value']);

				foreach ($unserial_data as $ud) {

					if($ud == 0){
						print_r($rs);

						die();
					}
					if (!empty($final_achievements[$ud])) {
						$final_achievements[$ud] = array(
							'voice' 			=> $final_achievements[$ud]['voice']+1,
							'description'		=> $data['achievements'][$ud]
						);
					}else{
						$final_achievements[$ud] = array(
							'voice' 		=> 1,
							'description'	=> $data['achievements'][$ud]
						);

					}

				}

			}

			usort($final_achievements, 'sortByVoice');

			$data['top_5'] = array();
			$main_score = 0;
			$i =0;
			foreach ($final_achievements  as $fa) {
				$i++;
				$data['top_5'][] = array(
					'achievement_id' 	=> $fa['description']['achievement_id'],
					'voice' 			=> $fa['voice'],
					'text_voice' 		=> sprintf($this->language->get('text_raiting_voice'),$fa['voice'], getNumEnding( $fa['voice'],array('москвич', 'москвича', 'москвичей'))),
					'image'		 		=> $fa['description']['achievement_image']
				);
				if($i ==5){break;}
			}

			if (!$this->request->server['HTTPS']) {
				$share_btn_ya = str_replace(HTTP_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']), $count);
			} else {
				$share_btn_ya = str_replace(HTTPS_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']), $count);
			}

			$data['raitings'][] = array(
				'raiting_id' 			=> $raiting['raiting_id'],
				'raiting_title' 		=> $raiting['title'],
			//	'raiting_voice' 		=> sprintf($this->language->get('text_raiting_voice'), $random_csore, getNumEnding($random_csore,array('человек', 'человека', 'человек'))),
				'raiting_href' 	 		=> $this->url->link('information/raiting/view', 'raiting_id=' . $raiting['raiting_id']),
				'top_5'					=> $data['top_5'],
				'share_btn_ya'			=> 'btn_'.$share_btn_ya
			);

		}

		shuffle($data['raitings']);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/raiting/raiting_top.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/raiting/raiting_top.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/raiting/raiting_top.tpl', $data));
		}

	}

	public function view(){
		if (isset($this->request->get['raiting_id'])) {
			$raiting_id = (int)$this->request->get['raiting_id'];
		} else {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
		$this->load->language('information/raiting');
		$this->load->model('tool/image');
		$this->load->model('catalog/raiting');
		$this->load->model('catalog/achievement');
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', '', 'SSL')
		);
		//подтянем информацию о рейтинге о рейтинге
		$rating_info = $this->model_catalog_raiting->getRaiting($raiting_id);

		//seo
		$this->document->setTitle($rating_info['meta_title']);
		$this->document->setDescription($rating_info['meta_description']);
		$this->document->setKeywords($rating_info['meta_keyword']);

		$data['heading_title'] = $rating_info['title'];
		$data['action_title'] = html_entity_decode($rating_info['action_title']);
		$data['raiting_id'] = $raiting_id;
		//подтянем списки достижений
		//получим список аветивных рейтингов
		$filter_data = array(
			'filter_status'    => 1,
			'filter_raiting_id' => $raiting_id,
			'sort'	=>	'd.score_id' ,
			'order' => 'DESC'
		);

		$achievements = $this->model_catalog_achievement->getAchievements($filter_data);

		$data['achievements'] = array();
		foreach ($achievements as $achievement) {
			if (!empty($achievement['image'])) {
				$image = $this->model_tool_image->resize($achievement['image'], 243,213,'h');
			}else{
				$image = $this->model_tool_image->resize('placeholder.png', 243,213,'h');
			}
			$data['achievements'][] = array(
				'achievement_id' 			=> $achievement['achievement_id'],
				'achievement_title' 		=> $achievement['title'],
				'score_id' 		=> $achievement['score_id'],
				'achievement_image' 		=> $image
			);
		}
		if($raiting_id != 8){
			shuffle($data['achievements']);
		}

		$data['count_achievements'] = count($data['achievements']);
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');



	  	if (!$this->request->server['HTTPS']) {
			$data['share_rbtn_ya']  = 'rbtn_'.str_replace(HTTP_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting_id));
		} else {
			$data['share_rbtn_ya']  ='rbtn_'.str_replace(HTTPS_SERVER, "", $this->url->link('information/raiting/view', 'raiting_id=' . $raiting_id));
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/raiting/raiting.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/raiting/raiting.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/raiting/raiting.tpl', $data));
		}

	}

	public function result(){
		if (isset($this->request->get['rshare_id']) ) {
			$raiting_share_id = $this->request->get['rshare_id'];
		}else{
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
		//определим с какой соц сети пришел рефер
		// ok - однокласник
		// fb - facebook
		// tw - twitter
		// vk - vkontakte
		$data['social'] = 'false';
		$template_name = 'raiting/my_rating_template.tpl';
		if(!empty($this->request->get['uid'])){
			$data['social'] = 'true';
			$social_name = $this->request->get['uid'];
			switch ($social_name) {
				case 'vk':
					$template_name = 'raiting/my_rating_template_vk.tpl';
					break;
				case 'fb':
					$template_name = 'raiting/my_rating_template_fb.tpl';
					break;
				case 'ok':
					$template_name = 'raiting/my_rating_template_fb.tpl';
					break;
				case 'tw':
					$template_name = 'raiting/my_rating_template_fb.tpl';
					break;
				default:
					$template_name = 'raiting/my_rating_template.tpl';
					break;
			}
		}
		//подгрузим модели и язык
		$this->load->language('information/raiting');
		$this->load->model('tool/image');
		$this->load->model('catalog/raiting');
		$this->load->model('catalog/achievement');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', '', 'SSL')
		);

		$data['heading_title']		= $this->language->get('text_your_choise');
		$data['sub_heading_title'] 	= $this->language->get('text_sub_your_choise');

		$more_link = $this->url->link('information/raiting/topresult', '', 'SSL');
		$data['text_more_raiting'] = sprintf( $this->language->get('text_more_raiting'), $more_link );

		//подтянем статистику
		$filter_data = array(
			'start'    	=> 0,
			'limit' 	=> 5
		);
		//$rating_id - рейтинг за котрый проголосовали
		$rating_id 		= 0;
		$my_choice 			= $this->model_catalog_raiting->getMyStatsForRaiting($raiting_share_id,$filter_data);
		if(empty($my_choice)){
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}



		$rating_id = $my_choice['raiting_id'];
		//подтянем инфу о рейтинге
		$rating_info = $this->model_catalog_raiting->getRaiting($rating_id);
		//подтянем наши рейтинги
		$data['my_choice'] 	= array();
		$unser_mydata = array();
		$unser_mydata = unserialize($my_choice['value']);

		foreach ($unser_mydata as $value) {
			$data['my_choice'][] = array(
				'achievement_id' 			=> $value
			);
		}

		//подтянем список достижений с каритками для всех
		$filter_data = array(
			'filter_status'    => 1,
			'filter_raiting_id' => $rating_id
		);
		$achievements = $this->model_catalog_achievement->getAchievements($filter_data);
		$data['achievements'] = array();
		foreach ($achievements as $achievement) {
			if (!empty($achievement['image'])) {
				$image = $this->model_tool_image->resize($achievement['image'], 77,70,'h');
				$bimage = $this->model_tool_image->resize($achievement['image'], 243,213,'h');
			}else{
				$image = $this->model_tool_image->resize('placeholder.png', 77,70,'h');
				$bimage = $this->model_tool_image->resize('placeholder.png', 243,213,'h');
			}

			$data['achievements'][$achievement['achievement_id']] = array(
				'achievement_id' 			=> $achievement['achievement_id'],
				'achievement_title' 		=> $achievement['title'],
				'score_id'					=> $achievement['score_id'],
				'achievement_image' 		=> $image,
				'achievement_imageb' 		=> $bimage,
			);
		}

		$share_bg_template = 'share/rating/moscow_5_share_bg.png';
		//делаеме картинку
		$old_image = $share_bg_template;
		//путь до геенреруемой картинки
		$new_image = 'result_share/'.$raiting_share_id.'.jpg';

		if (!is_file(DIR_IMAGE.$share_bg_template)) {
			return;
		}
		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image)) ) {
		//

			//
			$path = '';
			$directories = explode('/', dirname(str_replace('../', '', $new_image)));
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			//для шаблона рейтинга топ-5
			$image = new Image(DIR_IMAGE . $old_image);
			//404*226
			$background_file = DIR_IMAGE.'share/rating/moscow_5_share_new.png';


			$top_1 = $data['achievements'][$data['my_choice'][0]['achievement_id']]['achievement_image'];//243*213
			$text_top_1 = $data['achievements'][$data['my_choice'][0]['achievement_id']]['achievement_title'];
			$top_2 = $data['achievements'][$data['my_choice'][1]['achievement_id']]['achievement_image'];//243*213
			$text_top_2 = $data['achievements'][$data['my_choice'][1]['achievement_id']]['achievement_title'];
			$top_3 = $data['achievements'][$data['my_choice'][2]['achievement_id']]['achievement_image'];//243*213
			$text_top_3 = $data['achievements'][$data['my_choice'][2]['achievement_id']]['achievement_title'];
			$top_4 = $data['achievements'][$data['my_choice'][3]['achievement_id']]['achievement_image'];//243*213
			$text_top_4 = $data['achievements'][$data['my_choice'][3]['achievement_id']]['achievement_title'];
			$top_5 = $data['achievements'][$data['my_choice'][4]['achievement_id']]['achievement_image'];//243*213
			$text_top_5 = $data['achievements'][$data['my_choice'][4]['achievement_id']]['achievement_title'];

		//($background_file,$positionX,$positionY)
			$image->addImage($top_1,44,85,'jpeg');
			$image->addImage($top_2,124,85,'jpeg');
			$image->addImage($top_3,204,85,'jpeg');
			$image->addImage($top_4,282,85,'jpeg');
			$image->addImage($top_5,363,85,'jpeg');
			$image->addImage($background_file,202,113,'png');
			//$image->text($text_raiting,0,0,20,'FFFFFF');
			//text($text, $x = 0, $y = 0, $size = 5, $color = '000000') {
			$x =5;
			$y =45;
			$font_size = 12;

			$font_path = DIR_APPLICATION.'/assets/fonts/PFDinDisplay/PFDinDisplay.ttf';
			//получить название рейтинга
			$name_raiting = $rating_info['title'];
			// if($rating_id != 11){
			// 	$text_raiting = 'в сфере '. mb_strtolower($name_raiting) .' Москвы за 5 лет';
			// 	$image->addText($text_raiting,$font_size ,$x,$y,'FFFFFF',$font_path,15);
			// }
				$font_size = 7;

			$x =10;
			$y =120;
			$sign_line = 25;
			$image->addTextLine($text_top_1, $font_size , $x, $y,'000000',$font_path,$sign_line);

			$x =90;
			$y =120;

			$sign_line = 25;
			$image->addTextLine($text_top_2, $font_size , $x, $y,'000000',$font_path,$sign_line);

			$x =168;
			$y =120;
			$sign_line = 25;
			$image->addTextLine($text_top_3, $font_size , $x, $y,'000000',$font_path,$sign_line);

			$x =247;
			$y =120;
			$sign_line = 25;
			$image->addTextLine($text_top_4, $font_size , $x, $y,'000000',$font_path,$sign_line);

			$x =326;
			$y =120;
			$sign_line = 25;
			$image->addTextLine($text_top_5, $font_size , $x, $y,'000000',$font_path,$sign_line);

			$image->save(DIR_IMAGE . $new_image);
		}


		if ($this->request->server['HTTPS']) {
			$share_image = $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			$share_image = $this->config->get('config_url') . 'image/' . $new_image;
		}

		// ok - однокласник
		// fb - facebook
		// tw - twitter
		// vk - vkontakte

		//добавим url для шаринга для каждой соцсети

		$data['share_url_ok'] = $this->url->link('information/raiting/result', 'rshare_id='.$raiting_share_id.'&uid=ok', 'SSL');
		$data['share_url_vk'] = $this->url->link('information/raiting/result', 'rshare_id='.$raiting_share_id.'&uid=vk', 'SSL');
		$data['share_url_fb'] = $this->url->link('information/raiting/result', 'rshare_id='.$raiting_share_id.'&uid=fb', 'SSL');
		$data['share_url_tw'] = $this->url->link('information/raiting/result', 'rshare_id='.$raiting_share_id.'&uid=tw', 'SSL');
		if(!empty($this->request->get['uid'])){
			$social_name = $this->request->get['uid'];
			switch ($social_name) {
				case 'vk':
					$data['share_image'] = $this->model_tool_image->resize('share/rating/share_vk.jpg', 403,226,'h');
					$share_title = 'Участвуй в независимом народном рейтинге достижений москвы за последние 5 лет';
					$share_text = '';
					break;
				case 'fb':
					$data['share_image'] = $share_image;
					$share_title = 'Участвуй в независимом народном рейтинге достижений москвы за последние 5 лет';
					$share_text = '';
					break;
				case 'ok':
					$data['share_image'] = $share_image;
					$share_title = 'Участвуй в независимом народном рейтинге достижений москвы за последние 5 лет';
					$share_text = '';
					break;
				case 'tw':
					$data['share_image'] = $share_image;
					$share_title = 'Участвуй в независимом народном рейтинге достижений москвы за последние 5 лет';
					$share_text = '';
					break;
				default:
					$data['share_image'] = $share_image;
					$share_title = 'Участвуй в независимом народном рейтинге достижений москвы за последние 5 лет';
					$share_text = '';
					break;
			}
		}else{

			$data['share_image'] = $share_image;
			$share_title = 'Участвуй в независимом народном рейтинге достижений москвы за последние 5 лет';
			$share_text = '';
		}

		$this->document->setSocialImg($data['share_image']);
		$data['share_title'] = $share_title;
		$data['share_text']  = $share_text;
		$this->document->setTitle($data['share_title']);
		$this->document->setDescription($data['share_text']);




		//подтянем статистику для данного рейтинга
		$filter_data = array();
		$top_raitng = array();
		$raiting_stat =  $this->model_catalog_raiting->getStatsForRaiting($rating_id,$filter_data);


		//$data['achievements'] список достижений для данного события
		//общее количество проголосовавших
		$data['main_scores'] = sprintf($this->language->get('text_raiting_voice_mos'),count($raiting_stat),getNumEnding(count($raiting_stat), array('москвичей', 'москвичей', 'москвичей')) );
		//раскрутим статистику
		$final_achievements = array();
		foreach ($raiting_stat as $rs) {
			//раскрываем список
			$unserial_data = unserialize($rs['value']);
			//print_r('<pre>');
			//print_r($rs);
			//print_r('</pre>');
			foreach ($unserial_data as $ud) {
				if (!empty($final_achievements[$ud])) {
					$final_achievements[$ud] = array(
						'voice' 		=> $final_achievements[$ud]['voice']+1,
						'description'	=> $data['achievements'][$ud]
					);
				}else{
					$final_achievements[$ud] = array(
						'voice' 		=> 1,
						'description'	=> $data['achievements'][$ud]
					);
				//	print_r('<pre>');
				//	print_r($data['achievements'][$ud]);
				//	print_r('</pre>');
				//	print_r($ud);
				}
			}
		}
		//die();
		usort($final_achievements, 'sortByVoice');

		$data['top_5'] = array();
		$main_score = 0;
		foreach ($final_achievements  as $fa) {
			$data['top_5'][] = array(
				'achievement_id' 	=> $fa['description']['achievement_id'],
				'voice' 			=> $fa['voice'],
				'text_voice' 		=> sprintf($this->language->get('text_raiting_voice'),$fa['voice'], getNumEnding( $fa['voice'],array('москвичей', 'москвичей', 'москвичей'))),
			);
		}


		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$data['social_header'] 	= $this->load->controller('common/sheader');


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/'.$template_name)) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/'.$template_name, $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/'.$template_name, $data));
		}

	}
	public function ajaxsend(){
		$json = array();
		$this->language->load('information/occasion');
		$this->load->model('catalog/raiting');
		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			//делаем проверку есть ли такой пользователь
			$data_customer = array();

			if (!$this->customer->isLogged()) {
				$customer_id = 0;
				/*if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
					$customer = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);
					$customer_id = $customer['customer_id'];
				}else{
					$customer_id = $this->model_account_customer->addCustomer($this->request->post);
				}*/
				$data_customer = array();//$this->request->post;
			}else{
				$customer_id = $this->customer->getId();

				$data_customer = $this->model_account_customer->getCustomer($customer_id);
				//$data_customer['occasion_id'] = $this->request->post['occasion_id'];

			}

			//делаем запись голоса
			$array_share = $this->model_catalog_raiting->addVoice($this->request->post,$data_customer,$customer_id);
			//$this->session->data['success'] = $this->language->get('text_success');

			if ($array_share ) {
				$json['success'] = 1;
				$json['redirect'] = $this->url->link('information/raiting/result', 'rshare_id='.$array_share['rshare_id'], 'SSL');// str_replace('&amp;', '&', $this->url->link('information/raiting/result', '', 'SSL'))  ;
			}else{
				$this->error['warning'] = $this->language->get('error_warning');
				$json['error'] = $this->error;
			}

		}else {
			$json['error'] = $this->error;
        }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validate() {
		if(!$this->customer->isLogged()){
			/*if ((utf8_strlen($this->request->post['firstname']) < 3) || (utf8_strlen($this->request->post['firstname']) > 100)) {
				$this->error['firstname'] = $this->language->get('error_customer_name');
			}
			if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 100)) {
				$this->error['telephone'] = $this->language->get('error_customer_phone');
			}
			if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
				$this->error['email'] = $this->language->get('error_customer_email');
			}*/
		}
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
