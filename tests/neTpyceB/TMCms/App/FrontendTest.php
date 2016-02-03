<?php

namespace Tests\TMCms\App;

use TMCms\Admin\Entity\LanguageEntity;
use TMCms\Admin\Entity\LanguageEntityRepository;
use TMCms\App\Frontend;

class FrontendTest extends \PHPUnit_Framework_TestCase {
    public function setUp()
    {
        parent::setUp();

        $lng = new LanguageEntity();
        $lng->loadDataFromArray([
            'short' => 'XX',
            'long' => 'Language'
        ]);
        $lng->save();
    }

    public function testGetInstance()
    {
        $instance = Frontend::getInstance();
        $this->assertInstanceOf('TMCms\App\Frontend', $instance);
    }

    public function test__toString()
    {
        $instance = Frontend::getInstance();
        ob_start();
        echo $instance;
        $html = ob_get_clean();
        $this->assertTrue(is_string($html));
    }

    public function tearDown()
    {
        parent::tearDown();

        $lng = LanguageEntityRepository::findOneEntityByCriteria(['short' => 'XX']);
        $lng->deleteObject();
    }
}