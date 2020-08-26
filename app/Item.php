<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Item extends Model
{
    use Translatable;
  
    public static $rules = [
        'lang' => 'required',
        'item_name' => 'required|max:60',
        'item_key' => 'required|max:60',
        'item_desc' => 'required|min:10',
        'item_price' => 'required|integer',
        'genre_id' => 'required',
            // アップロードしたファイルのバリデーション設定
        'upfile' => [
            'required',
            'file',
            'image',
            'mimes:jpeg,png',
            'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ],
    ];

    public static $update_rules = [
        'lang' => 'required',
        'item_name' => 'required|max:60',
        'item_key' => 'required|max:60',
        'item_desc' => 'required|min:10',
        'item_price' => 'required|integer',
        'genre_id' => 'required',
    ];

    protected $fillable = [
        'lang',
        'item_name',
        'item_key',
        'item_desc',
        'item_price',
        'genre_id',
    ];
    
    
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
}
