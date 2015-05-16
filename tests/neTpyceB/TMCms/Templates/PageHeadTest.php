<?php

namespace neTpyceB\Tests\TMCms\Templates;

use neTpyceB\TMCms\App\Frontend;
use neTpyceB\TMCms\Files\MimeTypes;
use neTpyceB\TMCms\Templates\PageHead;

class PageHeadTest extends \PHPUnit_Framework_TestCase
{
    public function testsetHtmlTagAttributes() {
        PageHead::getInstance()
            ->addHtmlTagAttributes('īs_body')
        ;

        $html = Frontend::getInstance();

        $this->assertTrue(stripos($html, 'īs_body') !== false);
    }

    public function testGetMimeTypes() {
        $types = MimeTypes::getMimeTypes();

        $this->assertTrue(is_array($types));
    }

    public function testGetExtByMimeType() {
        $res = MimeTypes::getExtByMimeType('application/pdf');

        $this->assertEquals('pdf', $res);
    }
}