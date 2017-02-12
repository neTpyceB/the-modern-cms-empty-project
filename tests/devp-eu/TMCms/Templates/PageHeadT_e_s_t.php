<?php

namespace Tests\TMCms\Templates;

use TMCms\Admin\Entity\LanguageEntity;
use TMCms\App\Frontend;
use TMCms\Files\MimeTypes;
use TMCms\Routing\Languages;
use TMCms\Templates\PageHead;

// Create test language - w/o it frontend dies
if (!Languages::exists('xx')) {
    $language = new LanguageEntity();
    $language->loadDataFromArray([
        'short' => 'xx',
        'long' => 'Test language'
    ]);
    $language->save();
}

class PageHeadTest extends \PHPUnit_Framework_TestCase
{
    public function testsetHtmlTagAttributes()
    {
        PageHead::getInstance()
            ->addHtmlTagAttributes('īs_body');

        $html = Frontend::getInstance();

        $this->assertTrue(stripos($html, 'īs_body') !== false);
    }

    public function testGetMimeTypes()
    {
        $types = MimeTypes::getMimeTypes();

        $this->assertTrue(is_array($types));
    }

    public function testGetExtByMimeType()
    {
        $res = MimeTypes::getExtByMimeType('application/pdf');

        $this->assertEquals('pdf', $res);
    }
}