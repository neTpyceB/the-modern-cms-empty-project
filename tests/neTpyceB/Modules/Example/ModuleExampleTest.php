<?php

namespace neTpyceB\Tests\TMCms\Modules\RSS;

use TMCms\Modules\Example\ModuleExample;

class ModuleExampleTest extends \PHPUnit_Framework_TestCase {
    public function testBool() {
        $example = true;
        $this->assertTrue(is_bool($example));
    }

    public function testExample() {
        $this->assertTrue(is_array(ModuleExample::$tables));
    }
}