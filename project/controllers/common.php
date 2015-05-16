<?php
use neTpyceB\TMCms\Log\FrontendLogger;
use \neTpyceB\TMCms\Routing\Controller;
use neTpyceB\TMCms\Templates\PageHead;
use neTpyceB\TMCms\Templates\PageTail;

defined('INC') or exit;

class CommonController extends Controller {
	private $count = 0;

	public static function getComponents() {
//		FrontendLogger::getInstance()->write('Got components');
		return array(
			'title',
			'text' => array(
				'type' => 'textarea',
				'edit' => 'wysiwyg'
			),
            'tags' => [
                'type' => 'custom',
                'fields' => [
                    'title',
                    'area' => [
                        'type' => 'textarea'
                    ],
                    'active' => [
                        'type' => 'checkbox'
                    ],
                    'type' => [
                        'options' => ['yes', 'no']
                    ]
                ]
            ],
            'links' => [
                'type' => 'custom',
                'fields' => [
                    'title',
                    'link' => [
                        'edit' => 'files'
                    ]
                ]
            ]
		);
	}

	public function index() {
//		FrontendLogger::getInstance()->write('Showing index');
		PageHead::getInstance()
				->setFavicon(DIR_ASSETS_URL . 'favicon.ico')
				->addCssUrl('/public/assets/_.css')
				->addJsUrl('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js')
				->addJs('if (typeof jQuery == \'undefined\') {document.write(unescape("%3Cscript src=\'/public/assets/jquery-1.8.1.min.js\'%3E%3C/script%3E"));}')
		;

		PageTail::getInstance()
			->addJsUrl('/public/assets/_.js', true)
		;

//		FrontendLogger::getInstance()->write('Tail ready');
		return ['a' => $this->count()];
	}

	public function header() {
		return ['b' => $this->count(), 'a' => 'assasafsa'];
	}

	private function count() {
		return ++$this->count;
	}
}