<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransRespondenTable extends Migration
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
            'tanggal_survei' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'jenis_layanan_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'instansi_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'pendidikan_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'pekerjaan_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'umur' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'jenis_kelamin' => [
                'type'       => "ENUM('L', 'P')",
            ],
            'saran_masukan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jenis_layanan_id', 'ref_jenis_layanan', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('instansi_id', 'ref_instansi', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('pendidikan_id', 'ref_pendidikan', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('pekerjaan_id', 'ref_pekerjaan', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('trans_responden');
    }

    public function down()
    {
        $this->forge->dropTable('trans_responden');
    }
}
