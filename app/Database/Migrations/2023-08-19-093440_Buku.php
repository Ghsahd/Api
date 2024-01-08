<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_buku' => [
                'type' => 'int',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'kode_buku' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'judul_buku' => [
                'type' => 'varchar',
                'constraint' => '255',
            ],
            'pengarang' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'penerbit' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'tahun_terbit' => [
                'type' => 'date',
            ],
            'kategori' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'jumlah' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'lokasi_buku' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'lokasi_terbit' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'tanggal_masuk' => [
                'type'=> 'date',
            ],
        ]);

        $this->forge->addPrimaryKey('id_buku');
        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}
