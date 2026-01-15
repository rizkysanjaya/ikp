<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRefUnsurPelayananTable extends Migration
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
            'kode_unsur' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'nama_unsur' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ref_unsur_pelayanan');
    }

    public function down()
    {
        $this->forge->dropTable('ref_unsur_pelayanan');
    }
}
