<?php

namespace neTpyceB\Tests\TMCms\Admin;

use neTpyceB\TMCms\Admin\CmsLanguages;

class CmsLanguagesTest extends \PHPUnit_Framework_TestCase {
    public function testGetPairs() {
        $pairs = CmsLanguages::getPairs();

        $this->assertTrue(is_array($pairs));
        $this->assertTrue(count($pairs) > 0);
        $this->assertArrayHasKey('en', $pairs);
    }
}
