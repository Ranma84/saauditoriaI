<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
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
            'idclient' => [
                'type' => 'NVARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'idCreador' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => true
            ],
            'user' => [
                'type' => 'NVARCHAR',
                'unique' => true,
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'NVARCHAR',
                'unique' => true,
                'constraint' => '255',
            ],
            'telefono' => [
                'type' => 'NVARCHAR',
                'unique' => true,
                'constraint' => '10',
            ],
            'password' => [
                'type' => 'NVARCHAR',
                'constraint' => '250',
            ],
            'estado' => [
                'type' => 'TINYINT',
                'null' => true
            ],
            'idrol' => [
                'type' => 'INT',
                'unsigned' => true,
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
        $this->forge->addForeignKey('idclient', 'client', 'ruc','SET NULL','SET NULL');
        $this->forge->addForeignKey('idrol', 'rol', 'id','SET NULL','SET NULL');
        $this->forge->createTable('users');
  
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}