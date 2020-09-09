<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'genres' => \App\Genre::whereNull('parent_id')->
                where('lang', 'like', $lang. '%')->
                orderBy('genre_order', 'DESC')->with('children')->get(),

            'ordered_orders' => $seatSession->orders,
        ]);
    }

    public function index()
    {
        return view('items.index', [
            'items' => \App\Item::orderBy('item_order', 'DESC')->
                orderBy('id', 'DESC')->paginate(12),
        ]);
    }

    public function create_by_key(\App\Item $item)
    {
        $item->item_name = '【'. $item->item_name. '】の翻訳を入力してください';
        $item->item_desc = '【'. $item->item_desc. '】の翻訳を入力してください';
        return view('items.create_by_key', [
            'item' => $item
        ]);
    }
    public function store_by_key(Request $req, \App\Item $item)
    {
        $this->validate($req, \App\Item::$copy_rules);

        $new_item = new \App\Item();
        $new_item->fill($req->all());
        $new_item->item_price = $item->item_price;
        $new_item->item_order = $item->item_order;

        $new_item->image_path = str_random(40);
        Storage::disk('public')->copy($item->image_path, $new_item->image_path);

        $genre_jp = \App\Genre::find($item->genre_id);
        $genre = \App\Genre::where('genre_key', $genre_jp->genre_key)->where('lang', $req->lang)->first();
        $new_item->genre_id = $genre->id;

        $new_item->save();
        // dd($item->allergenIds());
        $new_item->allergenCopy($item->allergenIds(), $req->lang);

        return redirect('/items');
    }

    public function create(Request $req)
    {
        return view('items.create', [
            'allergensGroupByLang' => \App\Allergen::all()->groupBy('lang'),
            'allergenIds' => old('allergens') ? old('allergens') : [],
        ]);
    }

    public function store(Request $req)
    {
        $validator = $this->validate_original($req, \App\Item::$rules);
        if ($validator->fails()) {
            return redirect('/items/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $req->upfile;
        $file_name = basename($file->store('public'));
        $item = new \App\Item();
        $item->fill($req->all());
        $item->image_path = $file_name;
        $item->save();
        $item->allergenSet($req->allergens);

        return redirect('/items');
    }

    public function show($id)
    {
        //
    }

    public function edit(\App\Item $item)
    {
        return view('items.edit', [
            'item' => $item,
            'allergensGroupByLang' => \App\Allergen::all()->groupBy('lang'),
            'allergenIds' => old('allergens') ? old('allergens') : $item->allergenIds(),
        ]);
    }
    private function validate_original($req, $rules)
    {
        $validator = Validator::make($req->all(), $rules);

        $validator->after(function ($validator) use($req) {
            if( $req->lang !== 'ja_JP' ) {
                $orizinal = \App\Item::where('lang', 'ja_JP')->
                                where('item_key', $req->item_key)->first();
                if (!$orizinal) {
                    $validator->errors()->add('lang', 'まずは日本語で作成して下さい');
                } else {
                    $orizinal_genre = $orizinal->genre;
                    $this_case_genre = \App\Genre::find($req->genre_id);
                    if ($this_case_genre && $orizinal_genre->genre_key !== $this_case_genre->genre_key) {
                        $validator->errors()->add('genre_id', '日本語メニューのジャンルと異なります'.$orizinal_genre->genre_key. 'にしてください');
                    }
                    if ($this_case_genre && $this_case_genre->lang !== $req->lang) {
                        $validator->errors()->add('genre_id', 'ジャンルの言語が異なります'.$req->lang. 'にしてください');
                    }
                }
            } else {
                $this_case_genre = \App\Genre::find($req->genre_id);
                if ($this_case_genre && $this_case_genre->lang !== 'ja_JP') {
                    $validator->errors()->add('genre_id', 'ジャンルの言語が異なりますja_JPにしてください');
                }
            }
        });
        return $validator;
    }
    public function update(Request $req, \App\Item $item)
    {
        if( $req->delete_image ) {
            $validator = $this->validate_original($req, 
                                            \App\Item::$rules);
            if ($validator->fails()) {
                return redirect('/items/'. $item->id. '/edit')
                            ->withErrors($validator)
                            ->withInput();
            }

            $file = $req->upfile;
            $file_name = basename($file->store('public'));
            Storage::disk('public')->delete($item->image_path);
            $item->image_path = $file_name;
        } else {
            $validator = $this->validate_original($req,
                                            \App\Item::$update_rules);
            if ($validator->fails()) {
                return redirect('/items/'. $item->id. '/edit')
                            ->withErrors($validator)
                            ->withInput();
            }
        }
        $item->fill($req->all());
        $item->allergenSet($req->allergens);
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
