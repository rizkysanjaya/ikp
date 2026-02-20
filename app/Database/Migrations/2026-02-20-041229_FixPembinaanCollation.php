<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixPembinaanCollation extends Migration
{
    public function up()
    {
        // Fix Collation for trans_responden_pembinaan so it can JOIN with ref_instansi and ref_pendidikan
        $this->db->query("ALTER TABLE trans_responden_pembinaan CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
        
        $this->db->query("ALTER TABLE trans_responden_pembinaan MODIFY instansi_id VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
        $this->db->query("ALTER TABLE trans_responden_pembinaan MODIFY pendidikan_id VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    }

    public function down()
    {
        // Revert to original database defaults if necessary
    }
}
