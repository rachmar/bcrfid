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

        $teacher  = Role::where('name', 'Council')->first();

        $admin = new User();
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@bcrfid.com';
        $admin->password = bcrypt('1234');
        $admin->save();
        $admin->roles()->attach($admin);

    }
}
