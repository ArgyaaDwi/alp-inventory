<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',

            ],
            'brand_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',

            ],
            'description' => [
                'type' => 'Text',
                'null' => true
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'product_image' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'id_category' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'stock' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
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
        $this->forge->addForeignKey('id_category', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropForeignKey('products', 'products_id_category_foreign');
        $this->forge->dropTable('products');
    }
}
