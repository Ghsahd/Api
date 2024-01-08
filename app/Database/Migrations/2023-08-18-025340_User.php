<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'int',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'role' => [
                'type' => 'enum',
                'constraint'  => array('Admin','Anggota'),
            ],
            'id_anggota' => [
                'type' => 'int',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addPrimaryKey('id_user');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
