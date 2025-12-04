<?php

namespace App\Migrations;

use App\Core\Migration;

class M002_AddMiniDescription extends Migration
{
    public function up()
    {
        // MariaDB 10.6 supports IF NOT EXISTS for ADD COLUMN
        $sql = "ALTER TABLE posts ADD COLUMN IF NOT EXISTS mini_description TEXT AFTER title";
        $this->db->exec($sql);
    }
}
