<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Genre extends Model
{
    use Translatable;

    public static $rules = [
        'genre_key' => 'required|alpha_dash|max:60',
        'genre_name' => 'required|max:60',
        'genre_order' => 'integer',
        'lang' => 'required',
    ];

    protected $fillable = [
        'genre_key',
        'genre_name',
        'lang',
        'genre_order',
        'parent_id',
    ];

    public function items()
    {
        return $this->hasMany('App\Item');
    }
    public function parent()
    {
        return $this->belongsTo('App\Genre', 'parent_id');
    }
    public function children()
    {
        return $this->hasMany('App\Genre', 'parent_id')->orderBy('genre_order', 'DESC');
    }

    public function getHashAttribute()
    {
        return crc32($this->genre_key);
    }

    public static function optionsForSelectByLang($lang)
    {
        $ret = [];
        self::where('lang', $lang)->orderBy('genre_order', 'DESC')->each(function($genre) use(&$ret){
            $ret[$genre->id] = $genre->genre_name. "(". $genre->genre_key .")". "[". $genre->lang_jp ."]";
        });
        return $ret;
    }

    public static function optionsForSelect()
    {
        $ret = self::optionsForSelectWithOut();
        $ret[''] = 'ジャンル選択前に言語を選択してください';
        return $ret;
    }

    public static function optionsForSelectWithOut()
    {
        $ret = [];
        self::orderBy('genre_order', 'DESC')->each(function($genre) use(&$ret){
            $ret[$genre->id] = $genre->genre_name. "(". $genre->genre_key .")". "[". $genre->lang_jp ."]";
        });
        return $ret;
    }
    public static function optionsForGenreKey()
    {
        $ret = [];
        $ret[''] = 'ジャンルキーを選択してください';
        self::get()->groupBy('genre_key')->each(function($ary, $key) use(&$ret){
            $ret[$key] = $key;
        });
        return $ret;
    }

    public static function optionsForSelectParents()
    {
        $ret = [] ;
        $ret[''] = '階層構造にする場合は選択してください';
        self::whereNull('parent_id')->orderBy('genre_order', 'DESC')->each(function($genre) use(&$ret){
            $ret[$genre->id] = $genre->genre_name. "(". $genre->genre_key .")". "[". $genre->lang_jp ."]";
        });
        return $ret;
    }

    public static function optionsForSelectParentsByLang($lang, $id)
    {
        $ret = [] ;
        self::where('lang', $lang)->whereNull('parent_id')->orderBy('genre_order', 'DESC')->each(function($genre) use($id, &$ret){
            if($id !== $genre->id) {
                $ret[$genre->id] = $genre->genre_name. "(". $genre->genre_key .")". "[". $genre->lang_jp ."]";
            }
        });
        return $ret;
    }
    public function optionsForSelectParentsByLangForInstance()
    {
        $ret = self::optionsForSelectParentsByLang($this->lang, $this->id);
        $ret[''] = '階層構造にする場合は選択してください';
        return $ret;
    }
    public function saveOtherLangByKey()
    {
        try {
            collect(['en_US', 'zh_CN', 'ko_KR'])->each(function($langVal) {
                $new_genre = new \App\Genre();
                $new_genre->fill([
                    'lang' => $langVal,
                    'genre_name' => '【'. $this->genre_name. '】の翻訳を入れてください',
                    'genre_key' => $this->genre_key,
                    'genre_order' => $this->genre_order,
                    'parent_id' => $this->parent_id,
                ])->save();
            });
        } catch(\Illuminate\Database\QueryException $e) {
            // SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry
        }
    }
}
