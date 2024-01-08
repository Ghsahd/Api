<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BukuRusak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_buku_rusak' => [
                'type' => 'int',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'no_keluar' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'kode_buku' => [
                'type' => 'varchar',
                'constraint' => '50',
            ],
            'stok_awal' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'tanggal_keluar' => [
                'type' => 'date'
            ],
            'jumlah_rusak' => [
                'type' => 'int',
                'constraint' => '11',
            ],
            'keterangan' => [
                'type' => 'text',
            ],
        ]);

        $this->forge->addPrimaryKey('id_buku_rusak');
        $this->forge->createTable('buku_rusak');
    }

    public function down()
    {
        $this->forge->dropTable('buku_rusak');
    }
}
