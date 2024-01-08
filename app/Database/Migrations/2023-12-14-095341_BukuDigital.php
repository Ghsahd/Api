<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BukuDigital extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_buku_digital' => [
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
                'type' => 'varchar',
                'constraint' => '10',
            ],
            'kategori' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'jumlah' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'tanggal_masuk' => [
                'type'=> 'date',
            ],
            'link_sampul' => [
                'type' => 'text',
            ],
            'link' => [
                'type' => 'text',
            ]
        ]);

        $this->forge->addPrimaryKey('id_buku_digital');
        $this->forge->createTable('buku_digital');
    }

    public function down()
    {
        $this->forge->dropTable('buku_digital');
    }
}
