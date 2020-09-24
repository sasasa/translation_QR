<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait SeatCheckable
{
    public function seatCheck(Request $req, $seat_hash)
    {
        $seat = \App\Seat::where('seat_hash', $seat_hash)->first();
        if (!$seat)
        {
            return [false, false];
        }
        $seatSession = $seat->seatSession;
        if ($seatSession->session_key != $req->session_key)
        {
            return [false, false];
        }
        return [$seat, $seatSession];
    }
}