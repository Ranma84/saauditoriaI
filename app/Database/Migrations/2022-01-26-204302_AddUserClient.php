<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserClient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'iduser' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'idClient' => [
                'type' => 'NVARCHAR',
                'unique' => true,
                'constraint' => '255',
            ],
            'estado' => [
                'type' => 'TINYINT',
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
   
        $this->forge->addForeignKey('idClient', 'client', 'ruc');
        $this->forge->addForeignKey('iduser', 'users', 'id');
   
        $this->forge->createTable('UserClient');
    }

    public function down()
    {
        $this->forge->dropTable('UserClient');
    }
}