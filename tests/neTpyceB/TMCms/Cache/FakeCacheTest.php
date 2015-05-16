<?php

namespace neTpyceB\Tests\TMCms\Cache;

define('FAKECACHE_TEST_KEY', 'fake_test_key_'. mt_rand(0, 999));
define('FAKECACHE_TEST_VALUE', mt_rand(0, 999));

use neTpyceB\TMCms\Cache\Cacher;

class FakeCacheTest extends \PHPUnit_Framework_TestCase {
    public function testGetInstance()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();

        $this->assertInstanceOf('\neTpyceB\TMCms\Cache\FakeCache', $cacher);
    }


    public function testSet()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();
        $res = $cacher->set(FAKECACHE_TEST_KEY, FAKECACHE_TEST_VALUE, 30);

        $this->assertTrue($res);
    }

    public function testGet()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();
        $cacher->set(FAKECACHE_TEST_KEY, FAKECACHE_TEST_VALUE, 30);
        $res = $cacher->get(FAKECACHE_TEST_KEY);

        $this->assertNull($res);
    }

    public function testExists()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();
        $cacher->set(FAKECACHE_TEST_KEY, FAKECACHE_TEST_VALUE, 30);
        $res = $cacher->exists(FAKECACHE_TEST_KEY);

        $this->assertFalse($res);
    }

    public function testNonExists() {
        $cacher = Cacher::getInstance()->getFakeCacher();
        $res = $cacher->exists(FAKECACHE_TEST_KEY .'non_existing_string');

        $this->assertFalse($res);
    }

    public function testDelete()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();
        $cacher->set(FAKECACHE_TEST_KEY, FAKECACHE_TEST_VALUE, 30);
        $deleted = $cacher->delete(FAKECACHE_TEST_KEY);
        $res = $cacher->get(FAKECACHE_TEST_KEY);

        $this->assertTrue($deleted);
        $this->assertNull($res);
    }

    public function testDeleteAll()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();
        $cacher->set(FAKECACHE_TEST_KEY, FAKECACHE_TEST_VALUE, 30);
        $cacher->set(FAKECACHE_TEST_KEY .'2', FAKECACHE_TEST_VALUE, 30);

        $cacher->deleteAll();

        $res = $cacher->get(FAKECACHE_TEST_KEY);
        $res2 = $cacher->get(FAKECACHE_TEST_KEY. '2');

        $this->assertNull($res);
        $this->assertNull($res2);
    }

    public function testItWorks()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();

        $this->assertTrue($cacher->itWorks());
    }
}