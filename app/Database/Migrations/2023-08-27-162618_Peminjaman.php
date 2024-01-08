<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman' => [
                'type' => 'int',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'id_buku' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'id_anggota' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'enum',
                'constraint' => array('Pinjam','Kembali'),
            ],
            'tanggal_peminjaman' => [
                'type' => 'date',
            ],
            'tanggal_pengembalian' => [
                'type' => 'date',
            ],
        ]);
        $this->forge->addPrimaryKey('id_peminjaman');
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}
