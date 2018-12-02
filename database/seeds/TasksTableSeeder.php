<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('tasks')->insert([
		                               0 =>
			                               array (
		                               'user_id' => 2,
		                               'title' => 'Finish Laracasts',
		                               'body' => 'Finish watching Laravel 5.4 from scratch',
		                               'created_at' => Carbon::now(),
		                               'deleted_at' => NULL
			                               ),
		                               1 =>
			                               array (
				                               'user_id' => 2,
				                               'title' => 'Leave bubble gum at home',
				                               'body' => 'Leave bubble gum at home so no chewing, just ass kicking',
				                               'created_at' => Carbon::now(),
				                               'deleted_at' => NULL
			                               ),
		                               2 =>
			                               array (
				                               'user_id' => 2,
				                               'title' => 'Kick ass',
				                               'body' => 'Nothing to chew so just some ass kicking left',
				                               'created_at' => Carbon::now(),
				                               'deleted_at' => NULL
			                               )
	                               ]);

    }
}
