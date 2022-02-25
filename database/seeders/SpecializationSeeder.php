<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->specializationList() as $val) {

            DB::table('specelizations')->insert($val);
        }

    }

    private function specializationList() {

        return [


            ['title' => 'General Physician'],
            ['title' => 'Gynacologist'],
            ['title' => 'Nuroligist'],
          
        ];
    }
}
