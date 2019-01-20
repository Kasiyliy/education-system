<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Department;
use App\Subject;
use App\Certificate;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create(array('firstname' => 'Mr.', 'lastname' => 'Admin', 'login' => 'admin', 'email' => 'admin@university.test', 'group' => 'Admin', "password" => "demo123"));
        DB::table('department')->delete();
        Department::create(array('id' => '0', 'name' => 'Demo', 'code' => 'Demo', 'description' => 'Demo', 'deleted_at' => Carbon::now()->toDateTimeString()));
        DB::table('subject')->delete();
        Subject::create(array('id' => '0' , 'name' => 'Demo' , 'code' => 'Demo' , 'price' =>'Demo', 'description' => 'Demo', 'points' => 'Demo', 'plans' => 'Demo', 'deleted_at' => Carbon::now()->toDateTimeString() , 'department_id' => '0' , 'user_id' => '1'));
        DB::table('certificates')->delete();
        Certificate::create(array('id' => '0' , 'goden_do' => '1' , 'inspired_by' => 'ASTC global' , 'on_behalf_and_for' => 'ASTC global' , 'subject_id' => '0'));

    }

}
