<?php

namespace TMCms\Modules\Example;

use TMCms\Modules\IModule;
use TMCms\Traits\singletonInstanceTrait;

class ModuleExample implements IModule {
    use singletonInstanceTrait;

    public static $tables = [
        'items' => 'm_example',
        'groups' => 'm_example_groups',
    ];

    public static function getGroupPairs() {
        $groups = new ExampleGroupEntityRepository();
        return $groups->getPairs('title');
    }

    public static function getItemsByGroup(ExampleGroupEntity $group) {
        $items = new ExampleEntityRepository();
        $items->setWhereGroupId($group->getId());
        return $items->getAsArrayOfObjects();
    }
}