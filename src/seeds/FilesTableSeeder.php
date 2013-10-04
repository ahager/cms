<?php

class FilesTableSeeder extends Seeder {

	public function run()
	{
		// Reset table
		DB::table('files')->truncate();

	}

}
