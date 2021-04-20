<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsActiveUser extends Migration
{
	public function up()
	{
		//Creat new col
		$this->forge->addColumn('users', [
			'is_active' => ['type' => 'int', 'constraint' => 11]
		]);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropColumn('users', 'is_active');
	}
}
