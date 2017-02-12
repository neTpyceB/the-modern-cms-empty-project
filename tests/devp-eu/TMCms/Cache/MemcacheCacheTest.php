<?php

namespace Tests\TMCms\Cache;


define('MEMCACHECACHE_TEST_KEY', 'memcache_test_key_' . mt_rand(0, 999));
define('MEMCACHECACHE_TEST_VALUE', mt_rand(0, 999));

use TMCms\Cache\Cacher;
use TMCms\Cache\MemcacheCache;

class MemcacheCacheTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstance()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();

        $this->assertInstanceOf('\TMCms\Cache\MemcacheCache', $cacher);
    }

    public function testSet()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        $res = $cacher->set(MEMCACHECACHE_TEST_KEY, MEMCACHECACHE_TEST_VALUE, 30);

        // Set new
        $this->assertTrue($res);
    }

    public function testSetExistingKey()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        // Set new
        $cacher->set(MEMCACHECACHE_TEST_KEY, MEMCACHECACHE_TEST_VALUE, 30);
        // Update same
        $res = $cacher->set(MEMCACHECACHE_TEST_KEY, MEMCACHECACHE_TEST_VALUE, 30);

        // Set new
        $this->assertTrue($res);
    }

    public function testGet()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        $cacher->set(MEMCACHECACHE_TEST_KEY, MEMCACHECACHE_TEST_VALUE, 30);
        $res = $cacher->get(MEMCACHECACHE_TEST_KEY);

        $this->assertEquals(MEMCACHECACHE_TEST_VALUE, $res);
    }

    public function testExists()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        $cacher->set(MEMCACHECACHE_TEST_KEY, MEMCACHECACHE_TEST_VALUE, 30);
        $res = $cacher->exists(MEMCACHECACHE_TEST_KEY);

        $this->assertTrue($res);
    }

    public function testNonExists()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        $res = $cacher->exists(MEMCACHECACHE_TEST_KEY . 'non_existing_string');

        $this->assertFalse($res);
    }

    public function testDelete()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        $cacher->set(MEMCACHECACHE_TEST_KEY, MEMCACHECACHE_TEST_VALUE, 30);
        $deleted = $cacher->delete(MEMCACHECACHE_TEST_KEY);
        $res = $cacher->get(MEMCACHECACHE_TEST_KEY);

        $this->assertTrue($deleted);
        $this->assertNull($res);
    }

    public function testDeleteAll()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        $cacher->set(MEMCACHECACHE_TEST_KEY, MEMCACHECACHE_TEST_VALUE, 30);
        $cacher->set(MEMCACHECACHE_TEST_KEY . '2', MEMCACHECACHE_TEST_VALUE, 30);

        $cacher->deleteAll();

        $res = $cacher->get(MEMCACHECACHE_TEST_KEY);
        $res2 = $cacher->get(MEMCACHECACHE_TEST_KEY . '2');

        $this->assertNull($res);
        $this->assertNull($res2);
    }

    public function testItWorks()
    {
        $this->assertTrue(MemcacheCache::itWorks());
    }
}