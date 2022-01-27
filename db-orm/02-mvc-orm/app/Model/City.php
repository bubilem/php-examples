<?php

namespace SimpleOrmExample\Model;

use SimpleOrmExample\Util\Database\DB;

class City extends Main
{
    protected static $conf = [
        'attributes' => ['id', 'name', 'population', 'region_id'],
        'table' => 'city',
        'pk' => 'id'
    ];

    public function __construct(DB $db)
    {
        parent::__construct($db);
    }
}
