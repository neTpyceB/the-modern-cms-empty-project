<?php

namespace Tests\TMCms\Admin;

use TMCms\Admin\AdminLanguages;

class AdminLanguagesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPairs()
    {
        $pairs = AdminLanguages::getPairs();

        $this->assertTrue(is_array($pairs));
        $this->assertTrue(count($pairs) > 0);
        $this->assertArrayHasKey('en', $pairs);
    }
}
