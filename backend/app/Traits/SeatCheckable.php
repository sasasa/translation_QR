<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait SeatCheckable
{
    public function seatCheck(string $session_key, string $seat_hash): array
    {
        $seat = \App\Seat::where('seat_hash', $seat_hash)->first();
        if (!$seat)
        {
            return [false, false];
        }
        $seatSession = $seat->seatSession;
        if ($seatSession->session_key !== $session_key)
        {
            return [false, false];
        }
        return [$seat, $seatSession];
    }
}