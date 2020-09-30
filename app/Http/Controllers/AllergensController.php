<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllergensController extends Controller
{

    public function index()
    {
        return view('allergens.index', [
            'allergens' => \App\Allergen::orderBy('id', 'DESC')->paginate(12)
        ]);
    }

    public function create()
    {
        return view('allergens.create', [
        ]);
    }

    public function store(Request $req)
    {
        $this->validate($req, \App\Allergen::$rules);
        $allergen = new \App\Allergen();
        $allergen->fill($req->all())->save();

        return redirect('/allergens');
    }

    public function show($id)
    {
        //
    }

    public function edit(\App\Allergen $allergen)
    {
        return view('allergens.edit', [
            'allergen' => $allergen
        ]);
    }

    public function update(Request $req, \App\Allergen $allergen)
    {
        $this->validate($req, \App\Allergen::$rules);
        $allergen->fill($req->all())->save();

        return redirect('/allergens');
    }

    public function destroy(\App\Allergen $allergen)
    {
        $allergen->delete();

        return redirect('/allergens');
    }

    public function store_by_key(Request $req, \App\Allergen $allergen)
    {
        $allergen->saveOtherLangByKey();
        return redirect('/allergens');
    }
}
