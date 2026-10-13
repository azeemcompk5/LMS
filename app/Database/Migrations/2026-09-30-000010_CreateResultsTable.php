<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResultsTable extends Migration
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
            'exam_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'subject_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'marks_obtained' => [
                'type'       => 'DECIMAL',
                'constraint' => '6,2',
                'default'    => 0.00,
            ],
            'total_marks' => [
                'type'       => 'DECIMAL',
                'constraint' => '6,2',
                'default'    => 100.00,
            ],
            'grade' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
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
        $this->forge->addKey('exam_id');
        $this->forge->addKey('subject_id');

        $this->forge->addForeignKey(
            'student_id',
            'students',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'exam_id',
            'exams',
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

        $this->forge->createTable('results');
    }

    public function down()
    {
        $this->forge->dropTable('results');
    }
}