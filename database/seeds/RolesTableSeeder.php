<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'owner',
                'display_name' => '站长',
                'description' => '网站站长',
                'tag_color' => '#418aab',
                'created_at' => '2016-02-18 15:38:20',
                'updated_at' => '2016-07-21 19:05:41',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'admin',
                'display_name' => '管理员',
                'description' => '网站管理员',
                'tag_color' => '#bf216d',
                'created_at' => '2016-02-18 15:52:05',
                'updated_at' => '2017-05-02 10:32:56',
            ),
        ));


    }
}
