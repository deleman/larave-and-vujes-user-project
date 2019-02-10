<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class VueSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for($i=0;$i<100;$i++){
            DB::table('table_posts')->insert([
                'name' => str_random(20),
                'email' => str_random(15).'@gmail.com',
                'password' => bcrypt('secret'),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]);
       }
    }
}
