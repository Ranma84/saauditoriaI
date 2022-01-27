<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        
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
            'rol' => [
                'type' => 'INT',
                'constraint' => '25',
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
        $this->forge->createTable('users');
        $this->db->enableForeignKeyChecks();   
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}