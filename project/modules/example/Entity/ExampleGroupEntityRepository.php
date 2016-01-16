<?php

namespace TMCms\Modules\Example;

use TMCms\Orm\EntityRepository;

class ExampleGroupEntityRepository extends EntityRepository {
    protected $db_table = 'm_example';
    protected $translation_fields = ['title'];
    protected $table_structure = [
        'fields' => [
            'title' => [
                'type' => 'translation',
            ],
            'is_default' => [
                'type' => 'bool',
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