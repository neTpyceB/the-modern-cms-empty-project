<?php

namespace Tests\TMCms\HTML\Cms\Column;

use TMCms\HTML\Cms\CmsTable;
use TMCms\HTML\Cms\Column\ColumnAccept;

class ColumnAcceptTest extends \PHPUnit_Framework_TestCase
{
    public function testGetInstance() {
        $column = ColumnAccept::getInstance('accept');

        $this->assertInstanceOf('\TMCms\HTML\Cms\Column\ColumnAccept', $column);
    }

    public function testGetView() {
        $table = new CmsTable();

        $html = $table->addColumn(ColumnAccept::getInstance('accept'));

        $this->assertTrue(is_string($html->__toString()));
    }
}