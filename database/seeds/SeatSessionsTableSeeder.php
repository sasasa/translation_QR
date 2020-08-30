<?php

use Illuminate\Database\Seeder;

class SeatSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<10; $i++) {
            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 1,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 2,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 3,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 4,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 5,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 6,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 7,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 8,
                'session_state' => 'end_of_use',
            ])->save();

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->fill([
                'seat_id' => 9,
                'session_state' => 'end_of_use',
            ])->save();
            
        }
    }
}
