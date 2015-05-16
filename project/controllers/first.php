<?php
use \neTpyceB\TMCms\Routing\Controller;

defined('INC') or exit;

class FirstController extends Controller {
    public static function getComponents() {
        return array(
            'title',
            'title2',
            'title3',
            'text' => array(
                'type' => 'textarea',
                'edit' => 'wysiwyg'
            )
        );
    }

	public function index() {

	}
}