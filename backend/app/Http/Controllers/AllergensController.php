<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $this->validate($req, array_merge(\App\Allergen::$rules, [
            'allergen_key' => [
                'required',
                // allergen_key,langの組み合わせでユニークである
                Rule::unique('allergens')->where('lang', $req->lang),
            ],
        ]));

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
        if( !$allergen->items->isEmpty() ) {
            // 紐づけてあるならば削除できない
            session()->flash('message', $allergen->allergen_name. 'に紐づけてあるメニューが存在するため削除できません。');
        } else {
            $allergen->delete();
        }

        return redirect('/allergens');
    }

    public function store_by_key(Request $req, \App\Allergen $allergen)
    {
        $allergen->saveOtherLangByKey();
        return redirect('/allergens');
    }
}
