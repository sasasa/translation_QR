<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{

    public function genre($lang, $genre)
    {
        $item_query = \App\Item::query();
        $item_query->where('lang', 'like', $lang. '%');
        $item_query->whereHas('genre', function($q) use($genre){
            $q->where('genre_key', $genre);
        });

        return view('items.items', [
            'items' => $item_query->orderBy('id', 'DESC')->get(),
            'genres' => \App\Genre::whereNull('parent_id')->where('lang', 'like', $lang. '%')->orderBy('genre_order', 'ASC')->get(),
            'lang' => $lang,
            'current_genre' => $genre,
        ]);
    }

    public function index()
    {
        return view('items.index', [
            'items' => \App\Item::orderBy('id', 'DESC')->paginate(12),
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
