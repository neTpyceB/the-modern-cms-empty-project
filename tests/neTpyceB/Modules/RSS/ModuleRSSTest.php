<?php

namespace neTpyceB\Tests\TMCms\Modules\RSS;


use neTpyceB\TMCms\Modules\RSS\ModuleRSS;

class ModuleRSSTest extends \PHPUnit_Framework_TestCase {
    public function testPublish() {
        $rss = new ModuleRSS();
        $html = $rss->publish();

        $this->assertTrue(is_string($html));
    }
}