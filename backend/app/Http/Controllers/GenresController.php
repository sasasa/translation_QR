<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class GenresController extends Controller
{

    public function json_parents($lang)
    {
        return response()->json([
            'genres' => \App\Genre::optionsForSelectParentsByLang($lang, null)
        ]);
    }
    public function json_genres($lang)
    {
        return response()->json([
            'genres' => \App\Genre::optionsForSelectByLang($lang)
        ]);
    }

    public function index()
    {
        return view('genres.index', [
            'genres' => \App\Genre::orderBy('genre_order', 'DESC')->orderBy('id', 'DESC')->paginate(12)
        ]);
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $req)
    {
        $this->validate($req, array_merge(\App\Genre::$rules, [
            'genre_key' => [
                'required',
                'alpha_dash',
                'max:60',
                // genre_key,langの組み合わせでユニークである
                Rule::unique('genres')->where('lang', $req->lang),
            ],
        ]));
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
        if( $genre->item ) {
            // 紐づけてあるならば削除できない
            session()->flash('message', $genre->genre_name. 'に紐づけてあるメニューが存在するため削除できません。');
        } else {
            $genre->delete();
        }

        return redirect('/genres');
    }

    public function store_by_key(Request $req, \App\Genre $genre)
    {
        $genre->saveOtherLangByKey();
        return redirect('/genres');
    }
}
