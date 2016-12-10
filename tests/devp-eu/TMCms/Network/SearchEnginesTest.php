<?php

namespace Tests\TMCms\Network;

use TMCms\Network\SearchEngines;

define('SearchEngines_TEST_URL', 'http://www.subsub.subdomain.google.lv/search?sourceid=chrome&ie=UTF-8&q=whaka+whaka');

class SearchEnginesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSearchWord() {
        $res = SearchEngines::getSearchWord(SearchEngines_TEST_URL);

        $this->assertEquals('whaka whaka', $res);
    }

    public function testEmptyUrl() {
        $res = SearchEngines::getSearchWord('bla');

        $this->assertFalse($res);
    }

    public function testUnknownSearchEngine() {
        $res = SearchEngines::getSearchWord('http://unknown_se.com/search?q=whaka+whaka');

        $this->assertFalse($res);
    }

    public function testNoQuery() {
        $res = SearchEngines::getSearchWord('http://baidu.com/');

        $this->assertFalse($res);
    }

    public function testUnknownQueryKey() {
        $res = SearchEngines::getSearchWord('http://baidu.com/search?unknown_key=whaka+whaka');

        $this->assertFalse($res);
    }

    public function testWithMultiplePossibleKeys() {
        $res = SearchEngines::getSearchWord('http://szukaj.com/search?qt=whaka+whaka');

        $this->assertEquals('whaka whaka', $res);
    }
}