<?php
namespace App\Traits;

trait Translatable
{
    public static $selectKeys = [
        ''=>'言語を選択してください',
        'ja_JP'=>'日本語',
        'en_US'=>'英語',
        'zh_CN'=>'中国語',
        'ko_KR'=>'韓国語',
    ];

    public static $selectKeysWithoutJP = [
        ''=>'言語を選択してください',
        'en_US'=>'英語',
        'zh_CN'=>'中国語',
        'ko_KR'=>'韓国語',
    ];

    public function getLangJpAttribute()
    {
        return self::$selectKeys[$this->lang]. '('. $this->lang. ')';
    }
}