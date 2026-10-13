<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTimetableTable extends Migration
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
            'class_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'section_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'subject_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'teacher_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'day' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'start_time' => [
                'type' => 'TIME',
            ],
            'end_time' => [
                'type' => 'TIME',
            ],
            'room' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->addKey('class_id');
        $this->forge->addKey('section_id');
        $this->forge->addKey('subject_id');
        $this->forge->addKey('teacher_id');

        $this->forge->addForeignKey(
            'class_id',
            'classes',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'section_id',
            'sections',
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
            'teacher_id',
            'teachers',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('timetable');
    }

    public function down()
    {
        $this->forge->dropTable('timetable');
    }
}