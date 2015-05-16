<?php
namespace neTpyceB\Tests\TMCms\Cache;

use neTpyceB\TMCms\Cache\Cacher;

define('APCCACHE_TEST_KEY', 'apc_test_key_'. mt_rand(0, 999));
define('APCCACHE_TEST_value', mt_rand(0, 999));

class APCCacheTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstance()
    {
        $cacher = Cacher::getInstance()->getApcCacher();

        $this->assertInstanceOf('\neTpyceB\TMCms\Cache\ApcCache', $cacher);
    }


    public function testSet()
    {
        $cacher = Cacher::getInstance()->getApcCacher();
        $res = $cacher->set(APCCACHE_TEST_KEY, APCCACHE_TEST_value, 30);

        $this->assertTrue($res);
    }

    public function testGet()
    {
        $cacher = Cacher::getInstance()->getApcCacher();
        $cacher->set(APCCACHE_TEST_KEY, APCCACHE_TEST_value, 30);
        $res = $cacher->get(APCCACHE_TEST_KEY);

        $this->assertEquals(APCCACHE_TEST_value, $res);
    }

    public function testExists()
    {
        $cacher = Cacher::getInstance()->getApcCacher();
        $cacher->set(APCCACHE_TEST_KEY, APCCACHE_TEST_value, 30);
        $res = $cacher->exists(APCCACHE_TEST_KEY);

        $this->assertTrue($res);
    }

    public function testNonExists() {
        $cacher = Cacher::getInstance()->getApcCacher();
        $res = $cacher->exists(APCCACHE_TEST_KEY .'non_existing_string');

        $this->assertFalse($res);
    }

    public function testDelete()
    {
        $cacher = Cacher::getInstance()->getApcCacher();
        $cacher->set(APCCACHE_TEST_KEY, APCCACHE_TEST_value, 30);
        $deleted = $cacher->delete(APCCACHE_TEST_KEY);
        $res = $cacher->get(APCCACHE_TEST_KEY);

        $this->assertTrue($deleted);
        $this->assertNull($res);
    }

    public function testDeleteAll()
    {
        $cacher = Cacher::getInstance()->getApcCacher();
        $cacher->set(APCCACHE_TEST_KEY, APCCACHE_TEST_value, 30);
        $cacher->set(APCCACHE_TEST_KEY .'2', APCCACHE_TEST_value, 30);

        $cacher->deleteAll();

        $res = $cacher->get(APCCACHE_TEST_KEY);
        $res2 = $cacher->get(APCCACHE_TEST_KEY. '2');

        $this->assertNull($res);
        $this->assertNull($res2);
    }

    public function testItWorks()
    {
        $cacher = Cacher::getInstance()->getApcCacher();

        $this->assertTrue($cacher->itWorks());
    }
}