<?php

namespace TMCms\Modules\Example;

use TMCms\Orm\Entity;

/**
 * Class ExampleGroupEntity
 *
 * @method string getTitle()
 * @method setTitle(string $title)
 */
class ExampleGroupEntity extends Entity {
    protected $db_table = 'm_example_group';
    protected $translation_fields = ['title'];

    protected function beforeDelete()
    {
        // Delete all items included in ths group
        $items = new ExampleEntityRepository();
        $items->setWhereGroupId($this->getId());
        $items->deleteObjectCollection();

        parent::beforeDelete();
    }
}