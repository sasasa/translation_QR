<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Allergen extends Model
{
    use Translatable;

    public static $rules = [
        'allergen_key' => 'required|alpha_dash|max:60',
        'allergen_name' => 'required|max:60',
        'lang' => 'required',
    ];

    protected $fillable = [
        'allergen_key',
        'allergen_name',
        'lang',
    ];

    public function items()
    {
        return $this->belongsToMany('App\Item', 'allergen_item');
    }

    public function getNameJpAttribute()
    {
        if ($this->lang == "ja_JP") {
            return $this->allergen_name;
        } else {
            return \App\Allergen::where('lang', "ja_JP")->where('allergen_key', $this->allergen_key)->first()->allergen_name;
        }
    }
}
