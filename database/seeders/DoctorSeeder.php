<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specelization;
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

                $doctors = Doctor::where('name',$val['name'])->first();

                if($doctors === null) {

                    $specelizations = Specelization::where('title',$val['specialization'])->first();

                    $data = ['name' => $val['name'] , 'specialization' => $specelizations->id ];

                    DB::table('doctors')->insert($data);

                }

            }



    }


    private function doctorsList() {

        return [
            ['name' => 'jacob' , 'specialization' => 'General Physician'],
            ['name' => 'Seetharam' , 'specialization' => 'Gynacologist'],
            ['name' => 'Yachury' , 'specialization' => 'Nuroligist'],
            ['name' => 'Manglan' , 'specialization' => 'Nuroligist'],
            ['name' => 'Mary' , 'specialization' => 'Gynacologist'],
            ['name' => 'Meera' , 'specialization' => 'Gynacologist'],
            ['name' => 'Maya' , 'specialization' => 'Gynacologist'],
        ];
    }
}
