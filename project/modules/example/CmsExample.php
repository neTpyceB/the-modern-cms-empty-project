<?php

namespace neTpyceB\TMCms\Modules\Example;

use neTpyceB\TMCms\HTML\BreadCrumbs;
use neTpyceB\TMCms\HTML\Cms\CmsTable;
use neTpyceB\TMCms\Modules\ModuleManager;

ModuleManager::requireModule('groups');


class CmsExample
{
    public function _default()
    {
        echo BreadCrumbs::getInstance()
            ->addCrumb(__('All Items'))
        ;
        
        $items = new ExampleEntityRepository();

        echo CmsTable::getInstance()
            ->addData($items)
        ;
    }
}