<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRefPendidikanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'nama_pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ref_pendidikan');
    }

    public function down()
    {
        $this->forge->dropTable('ref_pendidikan');
    }
}
