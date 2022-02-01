<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuditoria extends Migration
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
            'idclient' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => true
            ],
            'idSupplier' => [
                'type' => 'NVARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'iduser' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => true
            ],
            'nombre' => [
                'type' => 'NVARCHAR',
                'constraint' => '255',
            ],
            'precio' => [
                'type' => 'FLOAT',
                'null' => true
            ],
            'observacion' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'fecha_inicio' => [
                'type' => 'DATETIME'
            ],
            'fecha_final' => [
                'type' => 'DATETIME'
            ],
            'fecha_modificada' => [
                'type' => 'DATETIME',
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
        $this->forge->addForeignKey('idlistas', 'listas','id','SET NULL','SET NULL');
        $this->forge->createTable('auditoria');
    }

    public function down()
    {
        $this->forge->dropTable('auditoria');
    }
}