<?php

use neTpyceB\TMCms\Routing\Controller;
use neTpyceB\TMCms\Templates\PageHead;
use neTpyceB\TMCms\Templates\PageTail;

defined('INC') or exit;

class CommonController extends Controller
{
    public function index()
    {
        PageHead::getInstance()
            ->setFavicon(DIR_ASSETS_URL . 'favicon.ico')
            ->addCssUrl(DIR_ASSETS_URL .  'css/styles.css')
            ->addJsUrl('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js')
            ->addJs('if (typeof jQuery == \'undefined\') {document.write(unescape("%3Cscript src=\'/public/assets/jquery-1.8.1.min.js\'%3E%3C/script%3E"));}');

        PageTail::getInstance()
            ->addJsUrl(DIR_ASSETS_URL . 'js/scripts.js', true);
    }

    public function header() {
        return [
            'main_title' => 'Main title is here'
        ];
    }
}