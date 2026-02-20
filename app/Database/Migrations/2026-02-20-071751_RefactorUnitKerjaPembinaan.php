<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RefactorUnitKerjaPembinaan extends Migration
{
    public function up()
    {
        // Adding layanan_id
        $this->forge->addColumn('trans_responden_pembinaan', [
            'layanan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'after'      => 'pekerjaan_id'
            ]
        ]);
        
        // Dropping the old string column
        $this->forge->dropColumn('trans_responden_pembinaan', 'unit_kerja_terkait');
    }

    public function down()
    {
        // Re-adding the old column
        $this->forge->addColumn('trans_responden_pembinaan', [
            'unit_kerja_terkait' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'pekerjaan_id'
            ]
        ]);
        
        // Dropping layanan_id
        $this->forge->dropColumn('trans_responden_pembinaan', 'layanan_id');
    }
}
