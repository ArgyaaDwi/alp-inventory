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
                'constraint' => 5,
                'unsigned' => true
            ],
            'id_status' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'damage_description' => [
                'type' => 'Text',
                'null' => true
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
        $this->forge->addForeignKey('id_status', 'status', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropForeignKey('products', 'fk_id_kategori');
        $this->forge->dropForeignKey('products', 'fk_id_status');
        $this->forge->dropTable('products');
    }
}
