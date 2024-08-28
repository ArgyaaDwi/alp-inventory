<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductStocks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_product' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'item_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'id_status' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'damage_description' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addForeignKey('id_product', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_status', 'status', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('product_stocks');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('product_stock', 'product_stock_product_id_foreign');
        // $this->forge->dropForeignKey('product_stock', 'product_stock_status_id_foreign');
        $this->forge->dropTable('product_stocks');
    }
}
