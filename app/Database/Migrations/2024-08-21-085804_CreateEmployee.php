<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployee extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'employee_badge' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'employee_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'employee_address' => [
                'type' => 'text'
            ],
            'employee_position' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'employee_email' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'employee_phone' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'employee_image' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'id_department' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'id_role' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'default' => true
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_department', 'departments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_role', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
        
    }
}
