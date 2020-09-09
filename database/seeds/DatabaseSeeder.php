<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AllergensTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SeatsTableSeeder::class);
        $this->call(SeatSessionsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
