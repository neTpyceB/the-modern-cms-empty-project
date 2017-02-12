<?php

namespace Tests\TMCms\Cache;


define('MEMCACHEDCACHE_TEST_KEY', 'memcached_test_key_' . mt_rand(0, 999));
define('MEMCACHEDCACHE_TEST_VALUE', mt_rand(0, 999));

use TMCms\Cache\Cacher;
use TMCms\Cache\MemcachedCache;

class MemcachedCacheTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstance()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();

        $this->assertInstanceOf('\TMCms\Cache\MEmcachedCache', $cacher);
    }

    public function testSet()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        $res = $cacher->set(MEMCACHEDCACHE_TEST_KEY, MEMCACHEDCACHE_TEST_VALUE, 30);

        // Set new
        $this->assertTrue($res);
    }

    public function testSetExistingKey()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        // Set new
        $cacher->set(MEMCACHEDCACHE_TEST_KEY, MEMCACHEDCACHE_TEST_VALUE, 30);
        // Update same
        $res = $cacher->set(MEMCACHEDCACHE_TEST_KEY, MEMCACHEDCACHE_TEST_VALUE, 30);

        // Set new
        $this->assertTrue($res);
    }

    public function testGet()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        $cacher->set(MEMCACHEDCACHE_TEST_KEY, MEMCACHEDCACHE_TEST_VALUE, 30);
        $res = $cacher->get(MEMCACHEDCACHE_TEST_KEY);

        $this->assertEquals(MEMCACHEDCACHE_TEST_VALUE, $res);
    }

    public function testExists()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        $cacher->set(MEMCACHEDCACHE_TEST_KEY, MEMCACHEDCACHE_TEST_VALUE, 30);
        $res = $cacher->exists(MEMCACHEDCACHE_TEST_KEY);

        $this->assertTrue($res);
    }

    public function testNonExists()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        $res = $cacher->exists(MEMCACHEDCACHE_TEST_KEY . 'non_existing_string');

        $this->assertFalse($res);
    }

    public function testDelete()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        $cacher->set(MEMCACHEDCACHE_TEST_KEY, MEMCACHEDCACHE_TEST_VALUE, 30);
        $deleted = $cacher->delete(MEMCACHEDCACHE_TEST_KEY);
        $res = $cacher->get(MEMCACHEDCACHE_TEST_KEY);

        $this->assertTrue($deleted);
        $this->assertNull($res);
    }

    public function testDeleteAll()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        $cacher->set(MEMCACHEDCACHE_TEST_KEY, MEMCACHEDCACHE_TEST_VALUE, 30);
        $cacher->set(MEMCACHEDCACHE_TEST_KEY . '2', MEMCACHEDCACHE_TEST_VALUE, 30);

        $cacher->deleteAll();

        $res = $cacher->get(MEMCACHEDCACHE_TEST_KEY);
        $res2 = $cacher->get(MEMCACHEDCACHE_TEST_KEY . '2');

        $this->assertNull($res);
        $this->assertNull($res2);
    }

    public function testItWorks()
    {
        $this->assertTrue(MemcachedCache::itWorks());
    }

    public function testGetResultCode()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();

        $this->assertNotNull($cacher->getResultCode());
    }
}