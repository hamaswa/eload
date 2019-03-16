<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $dev_permission = Permission::where('slug','*')->first();
	    $manager_permission = Permission::where('slug', 'search-info')->first();

	    $dev_role = new Role();
	    $dev_role->slug = 'admin';
	    $dev_role->name = 'Administrator';
	    $dev_role->save();
	    $dev_role->permissions()->attach($dev_permission);

	    $manager_role = new Role();
	    $manager_role->slug = 'reception';
	    $manager_role->name = 'Reception';
	    $manager_role->save();
	    $manager_role->permissions()->attach($manager_permission);
    }
}
