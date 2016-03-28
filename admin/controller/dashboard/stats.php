<?php
//статистика повсем тестам - 
//покажем сколько ползователей прошло каждый тест
class ControllerDashboardStats extends Controller {
	public function index() {
		
		
		return $this->load->view('common/stats.tpl', $data);
	}
}