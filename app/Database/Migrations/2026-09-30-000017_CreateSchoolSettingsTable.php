<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSchoolSettingsTable extends Migration
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
            'school_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'school_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'academic_year' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'currency' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'default'    => 'PKR',
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
        $this->forge->createTable('school_settings');
    }

    public function down()
    {
        $this->forge->dropTable('school_settings');
    }
}