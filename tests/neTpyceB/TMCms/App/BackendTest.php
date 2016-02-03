<?php

namespace Tests\TMCms\App;

use TMCms\Admin\Entity\LanguageEntity;
use TMCms\Admin\Entity\LanguageEntityRepository;
use TMCms\App\Backend;

class BackendTest extends \PHPUnit_Framework_TestCase {
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

    public function test__toString()
    {
        while (ob_get_level()) ob_get_clean();
        ob_start();
        $instance = new Backend;
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