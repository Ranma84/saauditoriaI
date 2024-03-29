<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSupplier extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ruc' => [
                'type' => 'NVARCHAR',
                'constraint' => 15
            ],
            'idclient' => [
                'type' => 'NVARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'idSegmento' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'razonSocial' => [
                'type' => 'NVARCHAR',
                'constraint' => 150,
            ],
            'nombreComercial' => [
                'type' => 'NVARCHAR',
                'constraint' => 150,
            ],
            'direccion' => [
                'type' => 'TEXT'
            ],
            'idPais' => [
                'type' => 'INT',
                'constraint' => '25',
                'null' => true
            ],
            'provincia' => [
                'type' => 'NVARCHAR',
                'constraint' => '250',
            ],
            'ciudad' => [
                'type' => 'NVARCHAR',
                'constraint' => '250',
            ],
            'direccionFactura' => [
                'type' => 'NVARCHAR',
                'constraint' => '250',
            ],
            'tipoContribuyente' => [
                'type' => 'NVARCHAR',
                'constraint' => '250',
            ],
            'actividadEmpresa' => [
                'type' => 'NVARCHAR',
                'constraint' => '250',
            ],
            'actividadEspecifica' => [
                'type' => 'NVARCHAR',
                'constraint' => '250',
            ],
            'telefono' => [
                'type' => 'NVARCHAR',
                'constraint' => '25',
            ],
            'fechaFacturacion' => [
                'type' => 'NVARCHAR',
                'constraint' => '25',
            ],
            'nombrePersonaContacto' => [
                'type' => 'NVARCHAR',
                'constraint' => '150',
            ],
            'cargoPersonaContacto' => [
                'type' => 'NVARCHAR',
                'constraint' => '150',
            ],
            'TelefonoPersonaContacto' => [
                'type' => 'NVARCHAR',
                'constraint' => '150',
            ],
            'mailPersonaContacto' => [
                'type' => 'NVARCHAR',
                'constraint' => '150',
            ],
            'codigoActivacion' => [
                'type' => 'NVARCHAR',
                'constraint' => '150',
            ],
            'estado' => [
                'type' => 'TINYINT',
                'null' => true
            ],
            'created_user' => [
                'type' => 'NVARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'updated_user' => [
                'type' => 'NVARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'deleted_user' => [
                'type' => 'NVARCHAR',
                'constraint' => '255',
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
        $this->forge->addPrimaryKey(['idClient','ruc']);
        $this->forge->addForeignKey('idclient', 'client', 'ruc','SET NULL','SET NULL');
        $this->forge->createTable('supplier');
    }

    public function down()
    {
        $this->forge->dropTable('supplier');
    }
}