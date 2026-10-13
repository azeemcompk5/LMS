<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExamSubjects extends Migration
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
            'exam_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'subject_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'total_marks' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 100,
            ],
            'exam_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'end_time' => [
                'type' => 'TIME',
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
        $this->forge->addKey('exam_id');

        $this->forge->createTable('exam_subjects');
    }

    public function down()
    {
        $this->forge->dropTable('exam_subjects');
    }
}