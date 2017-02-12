<?php

namespace Tests\TMCms\Admin;

use TMCms\Admin\Menu;

class MenuTest extends \PHPUnit_Framework_TestCase
{
    protected $menu_item = [
        'title' => 'Test item'
    ];

    public function testDisableMenu()
    {
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

    public function testGetMenuHeaderView()
    {
        // Test no auth
        ob_start();
        $menu = Menu::getInstance();
        echo $menu->getMenuHeaderView();
        $html = ob_get_clean();
        $this->assertTrue(is_string($html));

        // Test authed
        if (!defined('USER_ID')) define('USER_ID', 1);
        if (!defined('P')) define('P', 'guest');

        ob_start();
        $menu = Menu::getInstance();
        echo $menu->getMenuHeaderView();
        $html = ob_get_clean();
        $this->assertTrue(is_string($html));
    }

    public function testAddMenuItem()
    {
        $menu = Menu::getInstance();
        $res = $menu->addMenuItem('test', $this->menu_item);

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

    public function testAddMultipleItems()
    {
        // Test-related
        if (!defined('P')) define('P', 'guest');

        $menu = Menu::getInstance();

        $menu->addMenuItem('tools', $this->menu_item);
        $menu->addSubMenuItem('_default');
        $menu->addSubMenuItem('login');
        $menu->addHelpText('Help text');
        $menu->setMayAddItemsFlag(false);
        $menu->addMenuItem('users', $this->menu_item);
        $menu->addSubMenuItem('item');
        $menu->addSubMenuItem('_default');
        $menu->addSubMenuItem('exit');
        $menu->setMayAddItemsFlag(true);
        $menu->addMenuItem('third', $this->menu_item);
        $menu->addLabelForMenuItem('Label text', '_default', 'guest');
        $menu->addSubMenuItem('_default');
        $menu->addSubMenuItem('exit');

        $res = $menu->addMenuItem('guest', $this->menu_item);


        $this->assertEquals($menu, $res);
    }

    public function testSetAddingFlag()
    {
        $menu = Menu::getInstance();
        $res = $menu->setMayAddItemsFlag(false);

        $this->assertEquals($menu, $res);
    }
}