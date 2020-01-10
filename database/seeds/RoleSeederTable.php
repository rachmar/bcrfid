<?php

use App\Model\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        
        $osa = new Role();
        $osa->name = 'Admin';
        $osa->description = 'The Admin';
        $osa->save();

        $osa = new Role();
        $osa->name = 'OSA';
        $osa->description = 'The OSA';
        $osa->save();

        $principal = new Role();
        $principal->name = 'Principal';
        $principal->description = 'The Principal';
        $principal->save();

        $teacher = new Role();
        $teacher->name = 'Teacher';
        $teacher->description = 'The Teacher';
        $teacher->save();
        
    }
}
