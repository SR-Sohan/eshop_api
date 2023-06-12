<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Subcategory extends Migration
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
            "cat_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
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

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("cat_id","category","id",'CASCADE','CASCADE',"fkCatSub");

        $this->forge->createTable("subcategory");
    }

    public function down()
    {
        $this->forge->dropTable("subcategory");
    }
}
