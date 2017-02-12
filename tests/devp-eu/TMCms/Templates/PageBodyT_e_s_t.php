<?php

namespace Tests\TMCms\Templates;

use TMCms\Templates\PageBody;

define('PAGEBODY_TEST_VALUE', 'page_body_test_value');

class PageBodyTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithContent()
    {
        $body = new PageBody(PAGEBODY_TEST_VALUE);

        $res = $body->getContent();

        $this->assertEquals(PAGEBODY_TEST_VALUE, $res);
    }

    public function testSetAndGetContent()
    {
        $body = new PageBody;
        $obj = $body->setContent(PAGEBODY_TEST_VALUE);
        $res = $body->getContent();

        $this->assertEquals(PAGEBODY_TEST_VALUE, $res);
        $this->assertInstanceOf('TMCms\Templates\PageBody', $obj);
    }

    public function testToString()
    {
        $body = new PageBody(PAGEBODY_TEST_VALUE);

        ob_start();
        echo $body;
        $html = ob_get_clean();

        $this->assertEquals(PAGEBODY_TEST_VALUE, $html);
    }
}