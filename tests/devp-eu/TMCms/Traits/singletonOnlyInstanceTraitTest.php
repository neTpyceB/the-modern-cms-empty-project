<?php

namespace Tests\TMCms\Traits;

use TMCms\Traits\singletonOnlyInstanceTrait;

class singletonOnlyInstanceTraitTestInstance {
    use singletonOnlyInstanceTrait;

    public $test_key = '';
}

class singletonOnlyInstanceTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testCanHaveOnlySingleton() {
        // Two instance called with getInstance - are the same object
        $instance = singletonOnlyInstanceTraitTestInstance::getInstance();
        $instance->test_key = 'test';

        $instance2 = singletonOnlyInstanceTraitTestInstance::getInstance();

        // And may not call constructor
//        $instance3 = new singletonOnlyInstanceTraitTestInstance; / This is prohibited

        $this->assertEquals($instance->test_key, $instance2->test_key);
    }
}