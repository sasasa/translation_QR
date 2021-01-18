<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class SeatsController extends Controller
{

    public function index()
    {
        return view('seats.index', [
            'seats' => \App\Seat::orderBy('id', 'DESC')->paginate(12),
        ]);
    }


    public function create()
    {
        return view('seats.create', [
        ]);
    }


    public function store(Request $req)
    {
        $this->validate($req, \App\Seat::$rules);
        $seat = new \App\Seat();
        $seat->set_hash();
        $seat->fill($req->all())->save();

        return redirect('/seats');
    }

    public function rehash(\App\Seat $seat)
    {
        if ($seat->seat_state == \App\Seat::EMPTY) {
            $seat->set_hash();
            $seat->save();
        } else {
            Session::flash('message', '座席の状態が'. \App\Seat::$seat_states[\App\Seat::EMPTY]. 'でないと再生成できません');
        }

        return redirect('/seats');
    }


    public function show($id)
    {
        //
    }


    public function edit(\App\Seat $seat)
    {
        return view('seats.edit', [
            'seat' => $seat
        ]);
    }


    public function update(Request $req, \App\Seat $seat)
    {
        $this->validate($req, \App\Seat::$update_rules);
        // 重複チェック自分のはのぞいてチェックする
        $req->validate([
            'seat_name' => [Rule::unique('seats', 'seat_name')->whereNot('seat_name', $seat->seat_name)]
        ]);

        $seat->fill($req->all());
        $seat->save();

        return redirect('/seats');
    }


    public function destroy(\App\Seat $seat)
    {
        $seat->delete();

        return redirect('/seats');
    }

    public function qr_code(\App\Seat $seat)
    {
        $qrCode = $seat->qr_code;
        return response($qrCode->writeString(), 200)->header('Content-Type', $qrCode->getContentType());

    }

    public function print(\App\Seat $seat)
    {
        return view('seats.print', [
            'seat' => $seat
        ]);
    }
}
