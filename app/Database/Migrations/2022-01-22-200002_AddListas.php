<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddListas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'idsegmento' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => true
            ],
            'idclient' => [
                'type' => 'NVARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'nombre' => [
                'type' => 'NVARCHAR',
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
        $this->forge->addForeignKey('idsegmento','segmento','id','SET NULL','SET NULL');
        $this->forge->createTable('listas');
    }

    public function down()
    {
        $this->forge->dropTable('listas');
    }
}