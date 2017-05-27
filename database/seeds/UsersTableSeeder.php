<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'username' => 'admin',
                'display_name' => '管理员',
                'email' => 'admin@domain.com',
                'phone' => NULL,
                'password' => bcrypt('123456'),
                'api_token' => NULL,
                'confirmed' => 1,
                'confirmation_code' => NULL,
                'remember_token' => NULL,
                'created_at' => '2016-02-18 16:38:09',
                'updated_at' => '2017-05-19 11:15:06',
            ),
        ));


    }
}
