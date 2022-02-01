<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSegmento extends Migration
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
            'idclient' => [
                'type' => 'NVARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'nombre' => [
                'type' => 'NVARCHAR',
                'unique' => true,
                'constraint' => '255',
            ],
            'divison' => [
                'type' => 'NVARCHAR',
                'unique' => true,
                'constraint' => '3',
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
        $this->forge->addForeignKey('idclient', 'client', 'ruc','SET NULL','SET NULL');
        $this->forge->createTable('segmento');
    }

    public function down()
    {
        $this->forge->dropTable('segmento');
    }
}