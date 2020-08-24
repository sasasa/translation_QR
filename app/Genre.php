<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Genre extends Model
{
    use Translatable;
    
    public static $rules = [
        'genre_key' => 'required|max:60',
        'genre_name' => 'required|max:60',
        'lang' => 'required',
    ];

    protected $fillable = [
        'genre_key',
        'genre_name',
        'lang'
    ];

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public static function optionsForSelect()
    {
        $ret = [];
        self::orderBy('id', 'desc')->each(function($genre) use(&$ret){
            $ret[$genre->id] = $genre->genre_name. "(". $genre->genre_key .")". "[". $genre->lang_jp ."]";
        });
        return $ret;
    }
}
