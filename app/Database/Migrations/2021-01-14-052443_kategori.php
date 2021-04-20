<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
	public function up()
	{
		//Create Kategori table
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'name' => ['type' => 'varchar', 'constraint' => 25],
			'desc' => ['type' => 'varchar', 'constraint' => 25],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('kategori');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('kategori');
	}
}
