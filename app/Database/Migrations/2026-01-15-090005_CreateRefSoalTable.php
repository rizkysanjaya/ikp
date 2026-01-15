<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRefSoalTable extends Migration
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
            'jenis_layanan_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'unsur_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'pertanyaan' => [
                'type' => 'TEXT',
            ],
            'urutan' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jenis_layanan_id', 'ref_jenis_layanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('unsur_id', 'ref_unsur_pelayanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ref_soal');
    }

    public function down()
    {
        $this->forge->dropTable('ref_soal');
    }
}
