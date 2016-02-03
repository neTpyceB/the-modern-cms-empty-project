<?php

namespace Tests\TMCms\App;

use TMCms\Admin\Entity\LanguageEntity;
use TMCms\Admin\Entity\LanguageEntityRepository;
use TMCms\App\Frontend;

class FrontendTest extends \PHPUnit_Framework_TestCase {
    public function testGetInstance()
    {

        $lng = new LanguageEntity();
        $lng->loadDataFromArray([
            'short' => 'XX',
            'long' => 'Language'
        ]);
        $lng->save();

        $instance = Frontend::getInstance();
        $this->assertInstanceOf('TMCms\App\Frontend', $instance);


        $lng = LanguageEntityRepository::findOneEntityByCriteria(['short' => 'XX']);
        $lng->deleteObject();
    }

    public function test__toString()
    {

        $lng = new LanguageEntity();
        $lng->loadDataFromArray([
            'short' => 'XX',
            'long' => 'Language'
        ]);
        $lng->save();

        $instance = Frontend::getInstance();
        ob_start();
        echo $instance;
        $html = ob_get_clean();
        $this->assertTrue(is_string($html));


        $lng = LanguageEntityRepository::findOneEntityByCriteria(['short' => 'XX']);
        $lng->deleteObject();
    }
}