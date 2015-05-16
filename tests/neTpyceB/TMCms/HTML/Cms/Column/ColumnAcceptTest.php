<?php

namespace neTpyceB\Tests\TMCms\HTML\Cms\Column;

use neTpyceB\TMCms\HTML\Cms\CmsTable;
use neTpyceB\TMCms\HTML\Cms\Column\ColumnAccept;

class ColumnAcceptTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstance() {
        $column = ColumnAccept::getInstance('accept');

        $this->assertInstanceOf('\neTpyceB\TMCms\HTML\Cms\Column\ColumnAccept', $column);
    }

    public function testGetView() {
        $table = new CmsTable();

        $html = $table->addColumn(ColumnAccept::getInstance('accept'));

        $this->assertTrue(is_string($html->__toString()));
    }
}