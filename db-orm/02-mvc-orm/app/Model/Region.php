<?php

namespace SimpleOrmExample\Model;

use SimpleOrmExample\Util\Database\DB;

class Region extends Main
{
    protected static $conf = [
        'attributes' => ['id', 'name'],
        'table' => 'region',
        'pk' => 'id'
    ];

    public function __construct(DB $db)
    {
        parent::__construct($db);
    }
}
