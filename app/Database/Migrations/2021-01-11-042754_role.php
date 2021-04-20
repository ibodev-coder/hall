<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
	public function up()
	{


		// Role Table

		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'name' => ['type' => 'varchar', 'constraint' => 25],
			'desc' => ['type' => 'varchar', 'constraint' => 25],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('role');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//Drop table

		$this->forge->dropTable('role');
	}
}
