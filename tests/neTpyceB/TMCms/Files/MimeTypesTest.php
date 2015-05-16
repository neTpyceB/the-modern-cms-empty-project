<?php

namespace neTpyceB\Tests\TMCms\Files;

use neTpyceB\TMCms\Files\MimeTypes;

class MimeTypesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMimeType() {
        $res = MimeTypes::getMimeType('pdf');

        $this->assertEquals('application/pdf', $res);
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