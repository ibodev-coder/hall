<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Price extends Migration
{
	public function up()
	{
		//
		//Item Table
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'name' => ['type' => 'varchar', 'constraint' => 25,],
			'desc' => ['type' => 'varchar', 'constraint' => 25,],
			'price_id' => ['type' => 'int', 'constraint' => 11],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('price_id', 'price_item', 'id', 'NO ACTION', 'NO ACTION');
		$this->forge->createTable('items');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('items');
	}
}
