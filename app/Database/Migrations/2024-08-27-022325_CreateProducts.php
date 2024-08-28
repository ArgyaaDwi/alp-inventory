<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProducts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_brand' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'product_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'product_price' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'product_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'id_category' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_brand', 'brands', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_category', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('products', 'products_brand_id_foreign');
        // $this->forge->dropForeignKey('products', 'products_category_id_foreign');
        $this->forge->dropTable('products');
    }
}
