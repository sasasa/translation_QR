<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //一括削除
        \App\User::truncate();

        //特定のデータを追加
        for($i=0; $i<1; $i++)
        {
            \App\User::create([
                'name' => '社員'. $i,
                'email' => 'fulltime'.$i .'@gmail.com',
                'password' => bcrypt('hogehoge'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'permission' => \App\User::EDITING
            ]);
        }
        for($i=0; $i<0; $i++)
        {
            \App\User::create([
                'name' => 'バイト'. $i,
                'email' => 'parttime'.$i .'@gmail.com',
                'password' => bcrypt('hogehoge'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'permission' => \App\User::BROWSING
            ]);
        }
    }
}
