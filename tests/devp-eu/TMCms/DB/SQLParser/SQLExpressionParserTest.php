<?php

namespace Tests\TMCms\DB\SQLParser;

use TMCms\DB\SQLParser\SQLExpressionParser;

defined('INC') or exit;

class SQLExpressionParserTest extends \PHPUnit_Framework_TestCase
{
    public function testSetExpression()
    {
        $obj = new SQLExpressionParser('SELECT * FROM `table` WHERE `id` NOT IN (1,2)');
        $res = $obj->setExpression('SELECT * FROM `table2` WHERE `id` NOT IN (1,2)');

        $this->assertEquals($obj, $res);
    }

    public function testGetKey()
    {
        $obj = new SQLExpressionParser('SELECT * FROM `table` WHERE `id` NOT IN (1,2)');
        $res = $obj->getKey();

        $this->assertEquals('SELECT * FROM table WHERE id', $res);
    }

    public function test__toString()
    {
        $obj = new SQLExpressionParser('SELECT * FROM `table` WHERE `id` NOT IN (1,2)');
        ob_start();
        echo $obj;
        $res = ob_get_clean();

        $this->assertTrue(is_string($res));
    }
}