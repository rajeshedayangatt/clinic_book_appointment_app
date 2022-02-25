<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $book = $this->bookingList();
            foreach($book as $index => $val) {


                $doctors = Doctor::where('name',$val['doctor'])->first();

                $book[$index]['doctor'] =  $doctors->id;
                $book[$index]['specialization'] = $doctors->specialization;

                DB::table('bookings')->insert($book[$index]);

            }


    }


    private function bookingList() {

        return [
            ['specialization' => '1' , 'doctor' => 'jacob','patient' => 'Jeevan','appointment_date' => '2022-02-25',
                'start_time' => '13:07' , 'end_time' => '13:07' , 'information' => "Testing sed" ,
                'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')
            ],
            ['specialization' => '3' , 'doctor' => 'Seetharam','patient' => 'Rakshak','appointment_date' => '2022-02-25',
                'start_time' => '14:07' , 'end_time' => '14:07' , 'information' => "Meduarksasdasd sed" ,
                'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')
            ],

        ];
    }
}
