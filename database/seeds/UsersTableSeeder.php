<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    //factory('App\User', 50)->create();
	    $user = new App\User;
	    $user->name = 'admin';
	    $user->email = 'admin@'.config('app.theme').'.com';
	    $user->password = bcrypt('123456');
	    $user->type = App\User::TYPE_ADMIN;
	    $user->save();
    }
}
