<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 30;

        /** SCHED DB */
        for ($i = 0; $i < $limit; $i++) {
            DB::table('sched')->insert([ //,
                'sched_num' => $faker->numerify('Sched ###'),
                'timein' => $faker->time($format = 'H:i:s', $max = 'now'),
                'timeout' => $faker->time($format = 'H:i:s', $max = 'now'),
                'season' => $faker->randomElement($array = array ('winter','summer')),
                'created_at' => '2016-04-15 06:08:41',
                'updated_at' => '2016-04-15 06:08:41',
            ]);
        }

        /** RANK DB */
        for ($i = 0; $i < 3; $i++) {
            DB::table('rank')->insert([ //,
                'rank' => $faker->randomElement($array = array ('CSA 1','CSA 2','CSA 3')),
                'created_at' => '2016-04-15 06:08:41',
                'updated_at' => '2016-04-15 06:08:41',
             ]);
        }


//  applicable in route directly
//    Route::get('customers',function(){
//        $faker = Faker\Factory::create();
//
//        $limit = 10;
//
//        for ($i = 0; $i < $limit; $i++) {
//          echo  $faker->name . ', Email Address: ' . $faker->unique()->email . ', Contact No' . $faker->phoneNumber . '<br>';
//        }
//    });

    }
}
