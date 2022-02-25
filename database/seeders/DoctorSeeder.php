<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach($this->doctorsList() as $val) {

            DB::table('doctors')->insert($val);
        }


    }


    private function doctorsList() {

        return [
            ['name' => 'jacob' , 'specialization' => '1'],
            ['name' => 'Seetharam' , 'specialization' => '2'],
            ['name' => 'Yachury' , 'specialization' => '1'],
            ['name' => 'Manglan' , 'specialization' => '3'],
            ['name' => 'Mary' , 'specialization' => '2'],
            ['name' => 'Meera' , 'specialization' => '1'],
            ['name' => 'Maya' , 'specialization' => '3'],
        ];
    }
}
