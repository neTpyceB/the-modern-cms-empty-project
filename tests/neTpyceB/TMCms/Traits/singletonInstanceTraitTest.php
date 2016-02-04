<?php

namespace Tests\TMCms\Traits;

use TMCms\Traits\singletonInstanceTrait;

class singletonInstanceTraitTestInstance {
    use singletonInstanceTrait;

    public $test_key = '';
}

class singletonInstanceTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testCanHaveSingleton() {
        // Two instance called with getInstance - are the same object
        $instance = singletonInstanceTraitTestInstance::getInstance();
        $instance->test_key = 'test';

        $instance2 = singletonInstanceTraitTestInstance::getInstance();

        // But still can create new object
        $instance3 = new singletonInstanceTraitTestInstance;

        $this->assertEquals($instance->test_key, $instance2->test_key);
        $this->assertNotEquals($instance->test_key, $instance3->test_key);
    }
}