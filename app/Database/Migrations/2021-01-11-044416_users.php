<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		//User table
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'username' => ['type' => 'varchar', 'constraint' => 25],
			'email' => ['type' => 'varchar', 'constraint' => 55],
			'password' => ['type' => 'varchar', 'constraint' => 255],
			'telp' => ['type' => 'varchar', 'constraint' => 16],
			'role_id' => ['type' => 'int', 'constraint' => 11],
			'avatar' => ['type' => 'varchar', 'constraint' => 255],
			'create_at' => ['type' => 'datetime'],
			'update_at' => ['type' => 'datetime'],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('role_id', 'role', 'id');
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('users');
	}
}
