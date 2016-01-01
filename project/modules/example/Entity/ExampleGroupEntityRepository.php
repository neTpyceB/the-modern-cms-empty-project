<?php

namespace TMCms\Modules\Example;

use TMCms\Orm\EntityRepository;

class ExampleGroupEntityRepository extends EntityRepository {
    protected $db_table = 'm_example';
    protected $translation_fields = ['title'];
}