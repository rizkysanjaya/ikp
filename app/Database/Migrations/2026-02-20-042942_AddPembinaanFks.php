<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPembinaanFks extends Migration
{
    public function up()
    {
        // 1. Fix collations first! They MUST match the reference tables exactly.
        $this->db->query("ALTER TABLE trans_responden_pembinaan 
            MODIFY instansi_id VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
            MODIFY pendidikan_id VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
        ");

        // 2. trans_responden_pembinaan -> ref_instansi, ref_pendidikan, ref_pekerjaan
        $this->db->query("ALTER TABLE trans_responden_pembinaan 
            ADD CONSTRAINT fk_resp_pembinaan_instansi FOREIGN KEY (instansi_id) REFERENCES ref_instansi(id) ON DELETE SET NULL ON UPDATE CASCADE,
            ADD CONSTRAINT fk_resp_pembinaan_pendidikan FOREIGN KEY (pendidikan_id) REFERENCES ref_pendidikan(id) ON DELETE SET NULL ON UPDATE CASCADE,
            ADD CONSTRAINT fk_resp_pembinaan_pekerjaan FOREIGN KEY (pekerjaan_id) REFERENCES ref_pekerjaan(id) ON DELETE SET NULL ON UPDATE CASCADE
        ");

        // 2. trans_jawaban_pembinaan -> trans_responden_pembinaan, ref_pertanyaan_pembinaan, ref_opsi_jawaban
        // Note: trans_jawaban_pembinaan might already have old indexes for responden_pembinaan_id and pertanyaan_pembinaan_id but the constraints were missing/dropped.
        // Also opsi_jawaban_id needs to be INT UNSIGNED if ref_opsi_jawaban.id is INT UNSIGNED (Actually ref_opsi_jawaban.id is INT NOT NULL, signed!).
        // Let's make sure trans_jawaban_pembinaan.opsi_jawaban_id is just INT. It is.
        $this->db->query("ALTER TABLE trans_jawaban_pembinaan 
            ADD CONSTRAINT fk_jawab_pembinaan_responden FOREIGN KEY (responden_pembinaan_id) REFERENCES trans_responden_pembinaan(id) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT fk_jawab_pembinaan_pertanyaan FOREIGN KEY (pertanyaan_pembinaan_id) REFERENCES ref_pertanyaan_pembinaan(id) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT fk_jawab_pembinaan_opsi FOREIGN KEY (opsi_jawaban_id) REFERENCES ref_opsi_jawaban(id) ON DELETE SET NULL ON UPDATE CASCADE
        ");

        // 3. ref_pertanyaan_pembinaan -> ref_unsur_pembinaan
        $this->db->query("ALTER TABLE ref_pertanyaan_pembinaan 
            ADD CONSTRAINT fk_tanya_pembinaan_unsur FOREIGN KEY (unsur_id) REFERENCES ref_unsur_pembinaan(id) ON DELETE SET NULL ON UPDATE CASCADE
        ");
    }

    public function down()
    {
        // Revert constraints
    }
}
