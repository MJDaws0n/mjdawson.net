<?php

namespace App\Core;

use PDO;

abstract class Migration
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    abstract public function up();
}
