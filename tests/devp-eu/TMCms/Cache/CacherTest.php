<?php
namespace Tests\TMCms\Cache;

use TMCms\Cache\Cacher;

define('CACHER_TEST_KEY', 'cacher_test_key_' . mt_rand(0, 999));
define('CACHER_TEST_VALUE', mt_rand(0, 999));

class CacherTest extends \PHPUnit_Framework_TestCase
{

    public function testGetInstance()
    {
        $cacher = Cacher::getInstance();
        $this->assertInstanceOf('\TMCms\Cache\Cacher', $cacher);
    }

    public function testGetDefaultCacher()
    {
        $cacher = Cacher::getInstance()->getDefaultCacher();
        $class_name = get_class($cacher);
        $this->assertTrue($class_name == 'TMCms\Cache\FileCache' || $class_name == 'TMCms\Cache\MemcacheCache' || $class_name == 'TMCms\Cache\MemcachedCache');
    }

    public function testSetDefaultCacher()
    {
        $res = Cacher::getInstance()->setDefaultCacher('MemcacheCache');
        $this->assertTrue($res);
    }

    public function testGetFileCacher()
    {
        $cacher = Cacher::getInstance()->getFileCacher();
        $this->assertInstanceOf('TMCms\Cache\FileCache', $cacher);
    }

    public function testGetMemcacheCacher()
    {
        $cacher = Cacher::getInstance()->getMemcacheCacher();
        $this->assertInstanceOf('TMCms\Cache\MemcacheCache', $cacher);
    }

    public function testGetMemcachedCacher()
    {
        $cacher = Cacher::getInstance()->getMemcachedCacher();
        $this->assertInstanceOf('TMCms\Cache\MemcachedCache', $cacher);
    }

    public function testGetFakeCacher()
    {
        $cacher = Cacher::getInstance()->getFakeCacher();
        $this->assertInstanceOf('TMCms\Cache\FakeCache', $cacher);
    }

    public function testClearAllCaches()
    {
        $fileCacher = Cacher::getInstance()->getFileCacher();
        $memcachedCacher = Cacher::getInstance()->getMemcachedCacher();

        $fileCacher->set(CACHER_TEST_KEY, CACHER_TEST_VALUE);
        $memcachedCacher->set(CACHER_TEST_KEY, CACHER_TEST_VALUE);

        Cacher::getInstance()->clearAllCaches();

        $this->assertNull($fileCacher->get(CACHER_TEST_KEY));
        $this->assertNull($memcachedCacher->get(CACHER_TEST_KEY));
    }
}