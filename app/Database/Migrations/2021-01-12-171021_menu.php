<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
	public function up()
	{
		//
		//Set menu table
		$this->forge->addField(
			[
				'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
				'name' => ['type' => 'varchar', 'constraint' => 25],
				'role_id' => ['type' => 'int', 'constraint' => 11],

			]
		);
		$this->forge->addKey('id');
		$this->forge->addForeignKey('role_id', 'role', 'id');
		$this->forge->createTable('menu');
		// sub menu table
		$this->forge->addField([
			'menu_id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'name' => ['type' => 'varchar', 'constraint' => 25],
			'href' => ['type' => 'varchar', 'constraint' => 255],
			'icon' => ['type' => 'int', 'constraint' => 50]
		]);
		$this->forge->addForeignKey('menu_id', 'menu', 'id');
		$this->forge->createTable('sub_menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('menu');
		$this->forge->dropTable('sub_menu');
	}
}
