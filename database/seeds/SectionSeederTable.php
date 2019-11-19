<?php

use App\Model\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->truncate();
        
        $section = new Section();
        $section->grade = 11;
        $section->name = 'Jose Rizal';
        $section->save();

        $section = new Section();
        $section->grade = 11;
        $section->name = 'Andres Bonifacio';
        $section->save();

        $section = new Section();
        $section->grade = 12;
        $section->name = 'Apolinario Mabini';
        $section->save();

        $section = new Section();
        $section->grade = 12;
        $section->name = 'Emilio Aguinaldo';
        $section->save();
    }
}
