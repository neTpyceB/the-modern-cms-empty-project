<?php
use \neTpyceB\TMCms\Routing\Controller;

defined('INC') or exit;

class ServicesController extends Controller {
    public static function getComponents() {
        return array(
            'title',
            'text' => array(
                'type' => 'textarea',
                'edit' => 'wysiwyg'
            )
        );
    }

    public function index() {

    }
}