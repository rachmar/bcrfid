<?php

use App\User;
use App\Model\Role;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('user_roles')->truncate();

        $admin  = Role::where('name', 'Admin')->first();

        $admin = new User();
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@trident.com';
        $admin->username = 'admin';
        $admin->password = bcrypt('adminadmin');
        $admin->save();
        $admin->roles()->attach($admin);


        $teacher = new User();
        $teacher->name = 'Teacher Teacher';
        $teacher->email = 'teacher@trident.com';
        $teacher->username = 'teacher';
        $teacher->password = bcrypt('adminadmin');
        $teacher->save();
        $teacher->roles()->attach($admin);



    }
}
