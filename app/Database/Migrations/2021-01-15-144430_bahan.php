<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bahan extends Migration
{
	public function up()
	{
		//Table Bahan
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'name' => ['type' => 'varchar', 'constraint' => 25],
			'desc' => ['type' => 'varchar', 'constraint' => 25],
			'stok' => ['type' => 'int', 'constraint' => 11],
			'satuan' => ['type' => 'varchar', 'constraint' => 11],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('bahan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('bahan');
	}
}
