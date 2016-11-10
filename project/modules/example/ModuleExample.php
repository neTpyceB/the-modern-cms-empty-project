<?php

namespace TMCms\Modules\Example;

use TMCms\Modules\IModule;
use TMCms\Traits\singletonInstanceTrait;

/**
 * Class ModuleExample
 * @package TMCms\Modules\Example
 */
class ModuleExample implements IModule {
    use singletonInstanceTrait;

    /**
     * @return array
     */
    public static function getGroupPairs() {
        $groups = new ExampleGroupEntityRepository();
        return $groups->getPairs('title');
    }

    /**
     * @param ExampleGroupEntity $group
     * @return array
     */
    public static function getItemsByGroup(ExampleGroupEntity $group) {
        $items = new ExampleEntityRepository();
        $items->setWhereGroupId($group->getId());

        return $items->getAsArrayOfObjects();
    }
}