<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNoticesTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'target_audience' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'all',
            ],
            'publish_date' => [
                'type' => 'DATE',
            ],
            'expiry_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'active',
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
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
        $this->forge->addKey('created_by');

        $this->forge->addForeignKey(
            'created_by',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable('notices');
    }

    public function down()
    {
        $this->forge->dropTable('notices');
    }
}