<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addKey([
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
            "subcat_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "title" => [
                "type" => "VARCHAR",
                "constraint" => 256
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => 500
            ],
            "price" => [
                "type" => "INT",
                "constraint" => 11
            ],
            "quantity" => [
                "type" => "INT",
                "constraint" => 11
            ],
            "created_at" => [
                "type" => "DATETIME",
                "default" => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);

        $this->forge->addKey("id",true);
        $this->forge->addForeignKey("cat_id","category","id",'CASCADE','CASCADE',"fkCatProduct");
        $this->forge->addForeignKey("subcat_id","subcategory","id",'CASCADE','CASCADE',"fkCatSubProduct");
        $this->forge->createTable("products");
    }

    public function down()
    {
        $this->forge->dropTable("products");
    }
}
