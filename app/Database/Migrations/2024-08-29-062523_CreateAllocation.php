<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAllocation extends Migration
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
            'id_product_stock' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'allocation_type' => [
                'type'       => 'ENUM',
                'constraint' => ['person', 'area'],
                'default'    => 'person',
            ],
            'id_employee' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_area' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'allocation_date' => [
                'type' => 'DATETIME',
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->addForeignKey('id_product_stock', 'product_stocks', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_employee', 'employees', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_area', 'areas', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('allocations');
    }

    public function down() {
        $this->forge->dropTable('allocations');
    }
}
