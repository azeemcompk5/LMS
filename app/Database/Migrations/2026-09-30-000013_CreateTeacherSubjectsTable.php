<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeacherSubjectsTable extends Migration
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
            'teacher_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'subject_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'class_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('teacher_id');
        $this->forge->addKey('subject_id');
        $this->forge->addKey('class_id');

        $this->forge->addForeignKey(
            'teacher_id',
            'teachers',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'subject_id',
            'subjects',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'class_id',
            'classes',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('teacher_subjects');
    }

    public function down()
    {
        $this->forge->dropTable('teacher_subjects');
    }
}