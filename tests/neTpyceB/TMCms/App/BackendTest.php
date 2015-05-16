<?php

namespace neTpyceB\Tests\TMCms\App;


use neTpyceB\TMCms\App\Backend;

class BackendTest extends \PHPUnit_Framework_TestCase {
    public function test__toString()
    {
        while (ob_get_level()) ob_get_clean();
        ob_start();
        $instance = new Backend;
        echo $instance;
        $html = ob_get_clean();
        $this->assertTrue(is_string($html));
    }
}