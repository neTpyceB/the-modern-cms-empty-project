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
}