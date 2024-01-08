<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeminjamanOnline extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman_online' => [
                'type' => 'int',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'id_buku_digital' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'id_anggota' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'enum',
                'constraint' => array('Diterima','Ditolak'),
            ],
            'tanggal_peminjaman' => [
                'type' => 'date',
            ],
            'tanggal_pengembalian' => [
                'type' => 'date',
            ],
        ]);
        $this->forge->addPrimaryKey('id_peminjaman_online');
        $this->forge->createTable('peminjaman_online');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman_online');
    }
}
