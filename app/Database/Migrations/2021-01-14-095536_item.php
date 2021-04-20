<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Item extends Migration
{
	public function up()
	{
		// Price table
		$this->forge->addField(
			[
				'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
				'name' => ['type' => 'varchar', 'constraint' => 25],
				'price' => ['type' => 'int', 'constraint' => 11]
			]

		);
		$this->forge->addKey('id', true);
		$this->forge->createTable('price_item');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//

		$this->forge->dropTable('price_item');
	}
}
