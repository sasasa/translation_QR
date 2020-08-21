<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{

    public function items($lang)
    {
        return view('items.index', [
            'items' => \App\Item::where('lang', 'like', $lang. '%')->orderBy('id', 'DESC')->get(),
            'genres' => \App\Genre::where('lang', 'like', $lang. '%')->get(),
            'lang' => $lang
        ]);
    }

    public function genre($lang, $genre)
    {
        $item_query = \App\Item::query();
        $item_query->where('lang', 'like', $lang. '%');
        $item_query->whereHas('genre', function($q) use($genre){
            $q->where('genre_key', $genre);
        });

        return view('items.index', [
            'items' => $item_query->orderBy('id', 'DESC')->get(),
            'genres' => \App\Genre::where('lang', 'like', $lang. '%')->get(),
            'lang' => $lang
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
