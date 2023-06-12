<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Category extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true
            ],
            "title" => [
                "type" => "VARCHAR",
                "constraint" => 256
            ],
            "image" => [
                "type" => "VARCHAR",
                "constraint" => 256,
                "default" => null
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => 500
            ],
            "created_at" => [
                "type" => "DATETIME",
                "default" => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);

        $this->forge->addKey('id',true);
        $this->forge->createTable("category");
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}
