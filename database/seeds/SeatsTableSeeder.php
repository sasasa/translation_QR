<?php

use Illuminate\Database\Seeder;

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<10; $i++) {
            $seat = new \App\Seat();
            $seat->set_hash();
            $seat->fill([
                'seat_name' => 'S'. $i,
                'seat_state' => 'empty',
            ])->save();
        }
    }
}
