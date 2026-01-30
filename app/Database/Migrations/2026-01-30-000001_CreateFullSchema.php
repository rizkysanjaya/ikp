<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFullSchema extends Migration
{
    public function up()
    {
        // 1. ref_instansi
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 10], // Primary Key Manually Assigned
            'nama_instansi' => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ref_instansi', true);

        // 2. ref_jenis_layanan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'kode_layanan' => ['type' => 'VARCHAR', 'constraint' => 5, 'default' => '0'],
            'nama_layanan' => ['type' => 'VARCHAR', 'constraint' => 100],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ref_jenis_layanan', true);

        // 3. ref_pekerjaan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nama_pekerjaan' => ['type' => 'VARCHAR', 'constraint' => 100],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ref_pekerjaan', true);

        // 4. ref_pendidikan
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 10], // Primary Key Manually Assigned
            'nama_pendidikan' => ['type' => 'VARCHAR', 'constraint' => 100],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ref_pendidikan', true);

        // 5. ref_unsur_pelayanan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'kode_unsur' => ['type' => 'VARCHAR', 'constraint' => 5],
            'nama_unsur' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ref_unsur_pelayanan', true);

        // 6. ref_soal
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'jenis_layanan_id' => ['type' => 'INT', 'constraint' => 11],
            'unsur_id' => ['type' => 'INT', 'constraint' => 11],
            'pertanyaan' => ['type' => 'TEXT'],
            'urutan' => ['type' => 'INT', 'constraint' => 11, 'default' => 0, 'null' => true],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('jenis_layanan_id', 'ref_jenis_layanan', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('unsur_id', 'ref_unsur_pelayanan', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('ref_soal', true);

        // 7. ref_opsi_jawaban
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'soal_id' => ['type' => 'INT', 'constraint' => 11],
            'label_jawaban' => ['type' => 'VARCHAR', 'constraint' => 255],
            'bobot_nilai' => ['type' => 'INT', 'constraint' => 11],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('soal_id', 'ref_soal', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('ref_opsi_jawaban', true);

        // 8. trans_responden
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nama_lengkap' => ['type' => 'VARCHAR', 'constraint' => 150],
            'tanggal_survei' => ['type' => 'DATETIME', 'null' => true, 'default' => null], // Can depend on DB default, but usually handled by app
            'jenis_layanan_id' => ['type' => 'INT', 'constraint' => 11],
            'instansi_id' => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'pendidikan_id' => ['type' => 'VARCHAR', 'constraint' => 10],
            'pekerjaan_id' => ['type' => 'INT', 'constraint' => 11],
            'umur' => ['type' => 'INT', 'constraint' => 11],
            'jenis_kelamin' => ['type' => 'ENUM', 'constraint' => ['L', 'P']],
            'saran_masukan' => ['type' => 'TEXT', 'null' => true],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('jenis_layanan_id', 'ref_jenis_layanan', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('instansi_id', 'ref_instansi', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('pendidikan_id', 'ref_pendidikan', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('pekerjaan_id', 'ref_pekerjaan', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('trans_responden', true);

        // 9. trans_detail_jawaban
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'auto_increment' => true],
            'responden_id' => ['type' => 'INT', 'constraint' => 11],
            'soal_id' => ['type' => 'INT', 'constraint' => 11],
            'opsi_jawaban_id' => ['type' => 'INT', 'constraint' => 11],
            'nilai_skor' => ['type' => 'INT', 'constraint' => 11],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('responden_id', 'trans_responden', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('soal_id', 'ref_soal', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('opsi_jawaban_id', 'ref_opsi_jawaban', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('trans_detail_jawaban', true);

        // 10. users
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 100],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        // Drop in reverse order of dependency
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('trans_detail_jawaban', true);
        $this->forge->dropTable('trans_responden', true);
        $this->forge->dropTable('ref_opsi_jawaban', true);
        $this->forge->dropTable('ref_soal', true);
        $this->forge->dropTable('ref_unsur_pelayanan', true);
        $this->forge->dropTable('ref_pendidikan', true);
        $this->forge->dropTable('ref_pekerjaan', true);
        $this->forge->dropTable('ref_jenis_layanan', true);
        $this->forge->dropTable('ref_instansi', true);
    }
}
