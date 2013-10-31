<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();

			foreach (Pongo::system('user_details') as $name => $config) {

				$options = array($name);
				if(is_numeric($config['len'])) array_push($options, $config['len']); 

				call_user_func_array(array($table, $config['type']), $options);
			}

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_details');
	}

}
