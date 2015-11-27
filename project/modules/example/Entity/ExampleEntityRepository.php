<?php

namespace neTpyceB\TMCms\Modules\Example;

use neTpyceB\TMCms\Orm\EntityRepository;

/**
 * Class ExampleEntityRepository
 * @package neTpyceB\TMCms\Modules\Example
 *
 * @method setWhereGroupId(int $group_id)
 */
class ExampleEntityRepository extends EntityRepository {
    protected $db_table = 'm_example';
}