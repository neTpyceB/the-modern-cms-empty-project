<?php

namespace Tests\TMCms\Admin;

use TMCms\Admin\FrontPanel;

class FrontPanelTest extends \PHPUnit_Framework_TestCase
{
    public function testGetView()
    {
        $panel = new FrontPanel();

        ob_start();
        echo $panel->getView();
        $html = ob_get_clean();

        $this->assertTrue(is_string($html));
    }
}
