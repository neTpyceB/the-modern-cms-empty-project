<?php

namespace neTpyceB\Tests\TMCms\App;


use neTpyceB\TMCms\App\Frontend;

class FrontendTest extends \PHPUnit_Framework_TestCase {
    public function testGetInstance()
    {
        $instance = Frontend::getInstance();
        $this->assertInstanceOf('neTpyceB\TMCms\App\Frontend', $instance);
    }

    public function test__toString()
    {
        $instance = Frontend::getInstance();
        ob_start();
        echo $instance;
        $html = ob_get_clean();
        $this->assertTrue(is_string($html));
    }
}