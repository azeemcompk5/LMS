<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddClassSectionToStudents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('students', [
            'class_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'date_of_birth',
            ],
            'section_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'class_id',
            ],
        ]);

        $this->forge->addKey('class_id');
        $this->forge->addKey('section_id');

        $this->forge->addForeignKey(
            'class_id',
            'classes',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'section_id',
            'sections',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->forge->dropColumn('students', 'class_id');
        $this->forge->dropColumn('students', 'section_id');
    }
}