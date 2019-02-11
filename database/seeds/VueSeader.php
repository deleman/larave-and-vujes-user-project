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

       DB::table('table_posts')->insert([
        'name' => 'runner',
        'email' => 'zibarunner@gmail.com',
        'password' => bcrypt('secret'),
        'created_at'=> Carbon::now(),
        'updated_at'=> Carbon::now()
        ]);

        DB::table('table_posts')->insert([
         'name' => 'heideh',
         'email' => 'hediehrasouli@gmail.com',
         'password' => bcrypt('secret'),
         'created_at'=> Carbon::now(),
         'updated_at'=> Carbon::now()
         ]);

         DB::table('table_posts')->insert([
          'name' => 'soma',
          'email' => 'somaebrahimi@gmail.com',
          'password' => bcrypt('secret'),
          'created_at'=> Carbon::now(),
          'updated_at'=> Carbon::now()
          ]);

          DB::table('table_posts')->insert([
           'name' => 'mohammad',
           'email' => 'mohammad@gmail.com',
           'password' => bcrypt('secret'),
           'created_at'=> Carbon::now(),
           'updated_at'=> Carbon::now()
           ]);
    }
}
