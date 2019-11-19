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

        $role_osa  = Role::where('name', 'OSA')->first();
        $role_principal  = Role::where('name', 'Principal')->first();
        $role_teacher  = Role::where('name', 'Teacher')->first();

        $osa = new User();
        $osa->name = 'OSA OSA';
        $osa->email = 'osa@bcrfid.com';
        $osa->username = 'osa';
        $osa->password = bcrypt('adminadmin');
        $osa->save();
        $osa->roles()->attach($role_osa);

        $principal = new User();
        $principal->name = 'PRINCIPAL PRINCIPAL';
        $principal->email = 'principal@bcrfid.com';
        $principal->username = 'principal';
        $principal->password = bcrypt('adminadmin');
        $principal->save();
        $principal->roles()->attach($role_principal);

        $teacher = new User();
        $teacher->name = 'TEACHER TEACHER';
        $teacher->email = 'teacher@bcrfid.com';
        $teacher->username = 'teacher';
        $teacher->password = bcrypt('adminadmin');
        $teacher->save();
        $teacher->roles()->attach($role_teacher);



    }
}
