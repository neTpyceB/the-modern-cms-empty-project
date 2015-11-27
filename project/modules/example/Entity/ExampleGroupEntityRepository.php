<?php

namespace neTpyceB\TMCms\Modules\Example;

use neTpyceB\TMCms\Orm\EntityRepository;

class ExampleGroupEntityRepository extends EntityRepository {
    protected $db_table = 'm_example';
    protected $translation_fields = ['title'];
}