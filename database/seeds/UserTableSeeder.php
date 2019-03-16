<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $admin_role = Role::where('slug','admin')->first();
	    $reception_role = Role::where('slug', 'reception')->first();
	    $admin_perm = Permission::where('slug','*')->first();
	    $reception_perm = Permission::where('slug','search-info')->first();

	    $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'hamayun@yabi.co';
        $admin->password = bcrypt('secret@12');
        $admin->save();
        $admin->roles()->attach($admin_role);
        $admin->permissions()->attach($admin_perm);


        $reception = new User();
        $reception->name = 'Recption';
        $reception->email = 'recep@yabi.cosss';
        $reception->password = bcrypt('secret@12');
        $reception->save();
        $reception->roles()->attach($reception_role);
        $reception->permissions()->attach($reception_perm);
    }
}
