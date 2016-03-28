<?php
class ControllerCatalogRaiting extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/raiting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/raiting');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/raiting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/raiting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_raiting->addRaiting($this->request->post);

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

			$this->response->redirect($this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/raiting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/raiting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_raiting->editRaiting($this->request->get['raiting_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/raiting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/raiting');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $raiting_id) {
				$this->model_catalog_raiting->deleteRaiting($raiting_id);
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

			$this->response->redirect($this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'd.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
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
			'href' => $this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/raiting/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/raiting/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['raitings'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$raiting_total = $this->model_catalog_raiting->getTotalRaitings();

		$results = $this->model_catalog_raiting->getRaitings($filter_data);

		foreach ($results as $result) {
			$data['raitings'][] = array(
				'raiting_id' => $result['raiting_id'],
				'title'        => $result['title'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'        => $this->url->link('catalog/raiting/edit', 'token=' . $this->session->data['token'] . '&raiting_id=' . $result['raiting_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');


		$data['column_raiting_date_begin'] = $this->language->get('column_raiting_date_begin');
		$data['column_raiting_date_end'] = $this->language->get('column_raiting_date_end');
		$data['column_title'] = $this->language->get('column_title');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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

		$data['sort_title'] = $this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . '&sort=dd.title' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . '&sort=d.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $raiting_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($raiting_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($raiting_total - $this->config->get('config_limit_admin'))) ? $raiting_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $raiting_total, ceil($raiting_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/raiting/raiting_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['raiting_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['text_archive'] = $this->language->get('text_archive');
		$data['text_active'] = $this->language->get('text_active');
		$data['text_draft'] = $this->language->get('text_draft');
        $data['text_none'] = $this->language->get('text_none');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_raiting_date_begin'] = $this->language->get('entry_raiting_date_begin');
		$data['entry_raiting_date_end'] = $this->language->get('entry_raiting_date_end');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_visibility'] = $this->language->get('entry_visibility');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_season'] = $this->language->get('entry_season');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');

		$data['text_image'] = $this->language->get('text_image');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_image_manager'] = $this->language->get('text_image_manager');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
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

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
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
			'href' => $this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['raiting_id'])) {
			$data['action'] = $this->url->link('catalog/raiting/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/raiting/edit', 'token=' . $this->session->data['token'] . '&raiting_id=' . $this->request->get['raiting_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/raiting', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->get['raiting_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$raiting_info = $this->model_catalog_raiting->getRaiting($this->request->get['raiting_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['raiting_id'])) {
			$data['raiting_id'] = $this->request->get['raiting_id'];
		} else {
			$data['raiting_id'] = 0;
		}

		if (isset($this->request->post['raiting_description'])) {
			$data['raiting_description'] = $this->request->post['raiting_description'];
		} elseif (isset($this->request->get['raiting_id'])) {
			$data['raiting_description'] = $this->model_catalog_raiting->getRaitingDescriptions($this->request->get['raiting_id']);
		} else {
			$data['raiting_description'] = array();
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($raiting_info)) {
			$data['sort_order'] = $raiting_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($raiting_info)) {
			$data['keyword'] = $raiting_info['keyword'];
		} else {
			$data['keyword'] = '';
		}

		$data['ar_status'] = array();
		//дописать подтяжку со статусами
//******************************************************************/
		$data['ar_status'][] = array(
			'status_id' => 0,
			'title'		=> $this->language->get('text_archive')
		);
		$data['ar_status'][] = array(
			'status_id' => 1,
			'title'		=> $this->language->get('text_active')
		);
		$data['ar_status'][] = array(
			'status_id' => 2,
			'title'		=> $this->language->get('text_draft')
		);


//******************************************************************/
		$this->load->model('tool/image');

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($raiting_info['image'])) {
			$data['image'] = $raiting_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100,'h');
		} elseif (!empty($raiting_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($raiting_info['image'], 100, 100,'h');
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100,'h');
		}

		$data['no_image'] = $this->model_tool_image->resize('no_image.png', 100, 100,'h');

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($raiting_info)) {
			$data['status'] = $raiting_info['status'];
		} else {
			$data['status'] = 1;
		}

		if (isset($this->request->post['visibility'])) {
			$data['visibility'] = $this->request->post['visibility'];
		} elseif (!empty($raiting_info)) {
			$data['visibility'] = $raiting_info['visibility'];
		} else {
			$data['visibility'] = 1;
		}

        $this->load->model('catalog/season');
        $data['raiting_seasons'] = array();
        $seasons = array();
        $seasons = $this->model_catalog_season->getSeasons();
        foreach ($seasons as $season) {
            $data['raiting_seasons'][] = array(
                'season_id' => $season['season_id'],
                'title'     => $season['title']
            );
        }
        if (isset($this->request->post['season_id'])) {
            $data['season_id'] = $this->request->post['season_id'];
        } elseif (!empty($raiting_info)) {
            $data['season_id'] = $raiting_info['season_id'];
        } else {
            $data['season_id'] = 0;
        }


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/raiting/raiting_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/raiting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['raiting_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}
			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}


		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['raiting_id']) && $url_alias_info['query'] != 'raiting_id=' . $this->request->get['raiting_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['raiting_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/raiting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}



		return !$this->error;
	}


}
