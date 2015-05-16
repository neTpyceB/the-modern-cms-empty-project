<?php

namespace neTpyceB\Tests\TMCms\Admin;

use neTpyceB\TMCms\Admin\Menu;


class MenuTest extends \PHPUnit_Framework_TestCase {
    public function testDisableMenu() {
        $menu = Menu::getInstance();
        $menu->disableMenu();

        $this->assertFalse($menu->isMenuEnabled());
    }

    public function test__toString()
    {
        ob_start();
        $menu = Menu::getInstance();
        echo $menu;
        $html = ob_get_clean();
        $this->assertTrue(is_string($html));
    }

    public function testAddMenuItem()
    {
        $menu = Menu::getInstance();
        $res = $menu->addMenuItem('test');

        $this->assertEquals($menu, $res);
    }

    public function testAddSubMenuItem()
    {
        // Test-related
        if (!defined('P')) define('P', 'guest');
        $menu = Menu::getInstance();
        $res = $menu->addSubMenuItem('_default');

        $this->assertEquals($menu, $res);
    }

    public function testSetAddingFlag()
    {
        $menu = Menu::getInstance();
        $res = $menu->setAddingFlag(false);

        $this->assertEquals($menu, $res);
    }
}