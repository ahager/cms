<?php

class FilePageTableSeeder extends Seeder {

	public function run()
	{
		// Reset table
		DB::table('file_page')->truncate();

	}

}
