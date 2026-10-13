<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeesTable extends Migration
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
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'fee_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'default'    => 0.00,
            ],
            'due_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'paid_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'default'    => 0.00,
            ],
            'payment_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending',
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('student_id');
        $this->forge->addForeignKey('student_id', 'students', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('fees');
    }

    public function down()
    {
        $this->forge->dropTable('fees');
    }
}