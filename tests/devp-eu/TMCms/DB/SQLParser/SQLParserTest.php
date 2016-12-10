<?php

namespace Tests\TMCms\DB\SQLParser;

use TMCms\DB\SQLParser\SQLParser;

defined('INC') or exit;

class SQLParserTest extends \PHPUnit_Framework_TestCase
{
    public function testAddFlag()
    {
        $obj = new SQLParser('SELECT * FROM `table` WHERE `id` NOT IN (1,2)');
        $obj->addFlag('ALL');

        $this->assertTrue(is_object($obj));
    }
}