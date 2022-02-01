<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRequisitosAuditables extends Migration
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
            'idAuditoria' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
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
            'idgrupo' => [
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
            ],
            'valor' => [
                'type' => 'FLOAT',
                'null' => true
            ],
            'calificacion' => [
                'type' => 'TINYINT',
                'null' => true
            ],
            'question' => [
                'type' => 'NVARCHAR',
                'unique' => true,
                'constraint' => '255',
            ],
            'respuesta' => [
                'type' => 'INT',
                'null' => true
            ],
            'archivo' => [
                'type' => 'INT',
                'null' => true
            ],
            'observacion' => [
                'type' => 'TEXT',
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
        $this->forge->addForeignKey('idAuditoria', 'auditoria','id');
     //   $this->forge->addForeignKey('idRequisitosAuditables', 'requisitosAuditables','id');
        $this->forge->createTable('requisitosAuditados');
    }

    public function down()
    {
        $this->forge->dropTable('requisitosAuditados');
    }
}