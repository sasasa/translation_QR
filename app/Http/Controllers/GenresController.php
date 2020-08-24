<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenresController extends Controller
{

    public function index()
    {
        return view('genres.index', [
            'genres' => \App\Genre::orderBy('id', 'DESC')->paginate(12)
        ]);
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $req)
    {
        $this->validate($req, \App\Genre::$rules);
        $genre = new \App\Genre();
        $genre->fill($req->all())->save();

        return redirect('/genres');
    }

    public function show($id)
    {
        //
    }

    public function edit(\App\Genre $genre)
    {
        return view('genres.edit', [
            'genre' => $genre
        ]);
    }

    public function update(Request $req, \App\Genre $genre)
    {
        $this->validate($req, \App\Genre::$rules);
        $genre->fill($req->all())->save();

        return redirect('/genres');
    }

    public function destroy(\App\Genre $genre)
    {
        $genre->delete();

        return redirect('/genres');
    }
}
