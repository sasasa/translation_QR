<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{

    public function genre($seat_hash, $lang, $genre)
    {
        $seat = \App\Seat::where('seat_hash', $seat_hash)->first();
        if (!$seat)
        {
            return false;
        }

        return view('items.items', [
            'lang' => $lang,
            'current_genre' => $genre,
            'seat_hash' => $seat_hash,
            'session_key' => $seat->createSession(),
        ]);
    }

    public function json_items(Request $req, $seat_hash, $lang, $genre)
    {
        $seat = \App\Seat::where('seat_hash', $seat_hash)->first();
        if (!$seat)
        {
            return false;
        }
        $seatSession = $seat->seatSession;
        if ($seatSession->session_key != $req->session_key)
        {
            return false;
        }

        return response()->json([
            'items' => \App\Item::allForlangAndGenre($lang, $genre)->get(),
            'genres' => \App\Genre::whereNull('parent_id')->where('lang', 'like', $lang. '%')->orderBy('genre_order', 'DESC')->with('children')->get(),

            'ordered_orders' => $seatSession->orders,
        ]);
    }

    public function index()
    {
        return view('items.index', [
            'items' => \App\Item::orderBy('item_order', 'DESC')->orderBy('id', 'DESC')->paginate(12),
        ]);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $req)
    {
        $this->validate($req, \App\Item::$rules);
        $file = $req->upfile;
        $file_name = basename($file->store('public'));
        $item = new \App\Item();
        $item->fill($req->all());
        $item->image_path = $file_name;
        $item->save();

        return redirect('/items');
    }

    public function show($id)
    {
        //
    }

    public function edit(\App\Item $item)
    {
        return view('items.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $req, \App\Item $item)
    {
        if( $req->delete_image ) {
            $this->validate($req, \App\Item::$rules);

            $file = $req->upfile;
            $file_name = basename($file->store('public'));
            Storage::disk('public')->delete($item->image_path);
            $item->image_path = $file_name;
        } else {
            $this->validate($req, \App\Item::$update_rules);
        }
        $item->fill($req->all());
        $item->save();

        return redirect('/items');
    }

    public function destroy(\App\Item $item)
    {
        Storage::disk('public')->delete($item->image_path);
        $item->delete();

        return redirect('/items');
    }
}
