<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPembinaanTables extends Migration
{
    public function up()
    {
        // 1. Table: ref_pertanyaan_pembinaan
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_urut' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'pertanyaan' => [
                'type' => 'TEXT',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ref_pertanyaan_pembinaan');

        // 2. Table: trans_responden_pembinaan
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal_survei' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'instansi_terpilih' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'unit_kerja_terkait' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Radio button value
            ],
            'kelompok_usia' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
            ],
            'pendidikan_terakhir' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'tempat_pelaksanaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal_pelaksanaan' => [
                'type' => 'DATE',
            ],
            'metode_penyampaian' => [
                'type'       => 'ENUM',
                'constraint' => ['Luring', 'Daring'],
            ],
            'tema_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'saran_masukan' => [
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
        $this->forge->createTable('trans_responden_pembinaan');

        // 3. Table: trans_jawaban_pembinaan
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'responden_pembinaan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pertanyaan_pembinaan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'skor_jawaban' => [
                'type'       => 'INT',
                'constraint' => 1, // 1-4
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('responden_pembinaan_id', 'trans_responden_pembinaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pertanyaan_pembinaan_id', 'ref_pertanyaan_pembinaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('trans_jawaban_pembinaan');
    }

    public function down()
    {
        $this->forge->dropTable('trans_jawaban_pembinaan');
        $this->forge->dropTable('trans_responden_pembinaan');
        $this->forge->dropTable('ref_pertanyaan_pembinaan');
    }
}
