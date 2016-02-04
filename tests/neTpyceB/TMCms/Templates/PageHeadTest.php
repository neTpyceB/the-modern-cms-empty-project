<?php

namespace Tests\TMCms\Templates;

use TMCms\App\Frontend;
use TMCms\Files\MimeTypes;
use TMCms\Templates\PageHead;

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