<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransDetailJawabanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'responden_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'soal_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'opsi_jawaban_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'nilai_skor' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('responden_id', 'trans_responden', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('soal_id', 'ref_soal', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('opsi_jawaban_id', 'ref_opsi_jawaban', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('trans_detail_jawaban');
    }

    public function down()
    {
        $this->forge->dropTable('trans_detail_jawaban');
    }
}
