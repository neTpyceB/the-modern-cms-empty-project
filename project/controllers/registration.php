<?php
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;


class RegistrationModel extends View {
    /**
     * @return array
     */
    public function index() {
		if (!$_POST) return [];
		$result = module_clients::createClient($_POST);
		if (isset($result['error'])) {
			return [
				'error' => $result['error']
			];
		}
		module_sessions::start($result['data']['id']);
		go('/');
	}
}