<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRefInstansiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'nama_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ref_instansi');
    }

    public function down()
    {
        $this->forge->dropTable('ref_instansi');
    }
}
