<?php

use Illuminate\Database\Seeder;

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
        \App\User::create([
            'name' => 'root',
            'email' => 'masaakisaeki@gmail.com',
            'password' => Hash::make('hogehoge')
        ]);
    }
}
