<?php

namespace neTpyceB\Tests\TMCms\Cache;

define('FILECACHE_TEST_KEY', 'file_test_key_'. mt_rand(0, 999));
define('FILECACHE_TEST_VALUE', mt_rand(0, 999));

use neTpyceB\TMCms\Cache\Cacher;

class FileCacheTest extends \PHPUnit_Framework_TestCase {
    public function testGetInstance()
    {
        $cacher = Cacher::getInstance()->getFileCacher();

        $this->assertInstanceOf('\neTpyceB\TMCms\Cache\FileCache', $cacher);
    }


    public function testSet()
    {
        $cacher = Cacher::getInstance()->getFileCacher();
        $res = $cacher->set(FILECACHE_TEST_KEY, FILECACHE_TEST_VALUE, 30);

        $this->assertTrue($res);
    }

    public function testGet()
    {
        $cacher = Cacher::getInstance()->getFileCacher();
        $cacher->set(FILECACHE_TEST_KEY, FILECACHE_TEST_VALUE, 30);
        $res = $cacher->get(FILECACHE_TEST_KEY);

        $this->assertEquals(FILECACHE_TEST_VALUE, $res);
    }

    public function testExists()
    {
        $cacher = Cacher::getInstance()->getFileCacher();
        $cacher->set(FILECACHE_TEST_KEY, FILECACHE_TEST_VALUE, 30);
        $res = $cacher->exists(FILECACHE_TEST_KEY);

        $this->assertTrue($res);
    }

    public function testNonExists() {
        $cacher = Cacher::getInstance()->getFileCacher();
        $res = $cacher->exists(FILECACHE_TEST_KEY .'non_existing_string');

        $this->assertFalse($res);
    }

    public function testDelete()
    {
        $cacher = Cacher::getInstance()->getFileCacher();
        $cacher->set(FILECACHE_TEST_KEY, FILECACHE_TEST_VALUE, 30);
        $deleted = $cacher->delete(FILECACHE_TEST_KEY);
        $res = $cacher->get(FILECACHE_TEST_KEY);

        $this->assertTrue($deleted);
        $this->assertNull($res);
    }

    public function testDeleteAll()
    {
        $cacher = Cacher::getInstance()->getFileCacher();
        $cacher->set(FILECACHE_TEST_KEY, FILECACHE_TEST_VALUE, 30);
        $cacher->set(FILECACHE_TEST_KEY .'2', FILECACHE_TEST_VALUE, 30);

        $cacher->deleteAll();

        $res = $cacher->get(FILECACHE_TEST_KEY);
        $res2 = $cacher->get(FILECACHE_TEST_KEY. '2');

        $this->assertNull($res);
        $this->assertNull($res2);
    }

    public function testItWorks()
    {
        $cacher = Cacher::getInstance()->getFileCacher();

        $this->assertTrue($cacher->itWorks());
    }

    public function testNotExistsTooOldValue() {
        $cacher = Cacher::getInstance()->getFileCacher();

        $cacher->set(FILECACHE_TEST_KEY, FILECACHE_TEST_VALUE, -1); // One second in past
        $res = $cacher->get(FILECACHE_TEST_KEY);

        $this->assertNull($res);
    }
}
