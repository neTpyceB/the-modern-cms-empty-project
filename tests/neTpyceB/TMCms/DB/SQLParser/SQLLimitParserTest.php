<?php

namespace Tests\TMCms\DB\SQLParser;

use TMCms\DB\SQLParser\SQLLimitParser;

defined('INC') or exit;

class SQLLimitParserTest extends \PHPUnit_Framework_TestCase
{
    public function testSetOffset()
    {
        $obj = new SQLLimitParser('');
        $obj->setOffset(15);
        $obj->setLimit(2);

        $res = $obj->toSQL();
        $empty = $obj->isEmpty();

        $this->assertTrue(is_string($res));
        $this->assertFalse($empty);
    }
}