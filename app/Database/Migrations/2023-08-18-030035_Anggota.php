<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggota extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anggota' => [
                'type' => 'int',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'nomor_anggota' => [
                'type' => 'varchar',
                'constraint' => 10 
            ],
            'nama' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'text',
            ],
            'nomor_telepon' => [
                'type' => 'varchar',
                'constraint' => 20,
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            
        ]);
        $this->forge->addPrimaryKey('id_anggota');
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}
