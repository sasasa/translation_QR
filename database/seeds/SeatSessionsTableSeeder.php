<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SeatSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i=0; $i<24*30; $i++) {
        for ($i=0; $i<24*3; $i++) {
            $dt = new Carbon('2020-07-24 09:00:00');
            $now = $dt->addHours($i);


            $session = new \App\SeatSession();
            $session->insert([
                'seat_id' => 1,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 2,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 3,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 4,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 5,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 6,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 7,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 8,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $session = new \App\SeatSession();
            $session->set_hash();
            $session->insert([
                'seat_id' => 9,
                'session_key' => $session->set_hash(),
                'session_state' => 'end_of_use',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            
        }
    }
}
