<?php

use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = array (
            0 =>
                array (
                    'id' => 1,
                    'name' => '管理员',
                    'description' => '后台管理员角色',
                    'url' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48',
                    'status' => 1,
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => '测试',
                    'description' => '测试人员',
                    'url' => '1,2,18,19,20,21,22,23,24,25,26,27,28,29,30,31',
                    'status' => 1,
                ),
        );

        DB::table('admin_role')->insert($arr);
    }
}