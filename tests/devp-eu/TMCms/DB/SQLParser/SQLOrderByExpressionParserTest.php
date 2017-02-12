<?php

namespace Tests\TMCms\DB\SQLParser;

use TMCms\DB\SQLParser\SQLOrderByExpressionParser;

defined('INC') or exit;

class SQLOrderByExpressionParserTest extends \PHPUnit_Framework_TestCase
{
    public function testSetExpression()
    {
        $obj = new SQLOrderByExpressionParser('SELECT * FROM `table` WHERE `id` NOT IN (1,2) ORDER BY `id`');
        $res = $obj->setExpression('SELECT * FROM `table2` WHERE `id` NOT IN (1,2) ORDER BY `id`');

        $this->assertEquals($obj, $res);
    }

    public function testGetKey()
    {
        $obj = new SQLOrderByExpressionParser('SELECT * FROM `table` WHERE `id` NOT IN (1,2) ORDER BY `id`');
        $res = $obj->getKey();

        $this->assertEquals('SELECT * FROM table WHERE id', $res);
    }

    public function test__toString()
    {
        $obj = new SQLOrderByExpressionParser('SELECT * FROM `table` WHERE `id` NOT IN (1,2) ORDER BY `id`');
        ob_start();
        echo $obj;
        $res = ob_get_clean();

        $this->assertTrue(is_string($res));
    }
}