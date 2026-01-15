<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRefOpsiJawabanTable extends Migration
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
            'soal_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'label_jawaban' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'bobot_nilai' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('soal_id', 'ref_soal', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ref_opsi_jawaban');
    }

    public function down()
    {
        $this->forge->dropTable('ref_opsi_jawaban');
    }
}
