<?php

namespace TMCms\Modules\Example;

use TMCms\Orm\EntityRepository;

/**
 * Class ExampleEntityRepository
 * @package TMCms\Modules\Example
 *
 * @method setWhereGroupId(int $group_id)
 */
class ExampleEntityRepository extends EntityRepository {
    protected $db_table = 'm_example';
    protected $translation_fields = ['title'];

    protected $table_structure = [
        'fields' => [
            'group_id' => [
                'type' => 'index',
            ],
            'title' => [
                'type' => 'translation',
            ],
            'price' => [
                'type' => 'float',
                'unsigned' => true,
                'length' => '5.2',
            ],
            'active' => [
                'type' => 'bool',
            ],
            'order' => [
                'type' => 'int',
                'unsigned' => true,
            ],
        ],
    ];
}