<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMenu extends Migration
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
        'idrol' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'nombre_menu' => [
            'type' => 'NVARCHAR',
            'unique' => true,
            'constraint' => '255',
        ],
        'url' => [
            'type' => 'NVARCHAR',
            'unique' => true,
            'constraint' => '255',
        ],
        'tipo' => [
            'type' => 'NVARCHAR',
            'constraint' => '255',
        ],
        'icono' => [
            'type' => 'NVARCHAR',
            'constraint' => '255',
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
    $this->forge->addForeignKey('idrol','rol', 'id');
    $this->forge->createTable('menus');
}

public function down()
{
  $this->forge->dropTable('menus');
}
}
