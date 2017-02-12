<?php

namespace Tests\TMCms\App;

use TMCms\Config\Settings;

class SettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $res = Settings::getInstance()->init();

        $this->assertTrue(is_array($res));
    }

    public function testSetAndGet()
    {
        $res = Settings::getInstance()->get('non-existing');

        $this->assertNull($res);

        Settings::getInstance()->set('non-existing-test', 1);
        $res = Settings::getInstance()->get('non-existing-test');

        $this->assertEquals(1, $res);
    }

    public function testClear()
    {
        Settings::getInstance()->set('m_test_non-existing-test', 1);
        $res = Settings::getInstance()->clear('m_test', true);

        $this->assertTrue($res);
    }
}