<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGgrupo extends Migration
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
            'idClient' => [
                'type' => 'NVARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'idsegmento' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => true
            ],
            'idlistas' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => true
            ],
            'nombre' => [
                'type' => 'NVARCHAR',
                 'constraint' => '255',
            ],
            'valor' => [
                'type' => 'FLOAT',
                'null' => true
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
        $this->forge->addForeignKey('idlistas', 'listas','id');
        $this->forge->createTable('grupo');
    }

    public function down()
    {
        $this->forge->dropTable('grupo');
    }
}