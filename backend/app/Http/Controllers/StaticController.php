<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    private function info()
    {
        return [
            'url' => env('APP_URL', 'https://localhost'). '/law',
            'companyName' => 'ホゲホゲ食堂',
            'companyAddress' => '福岡県福岡市西区1-2-3',
            'tel' => '092-877-1234',
            'representative' => '後藤紀夫(代表取締役社長)',
        ];
    }
    
    public function policy()
    {
        return view('static.policy', $this->info());
    }
    
    public function law()
    {
        return view('static.law', $this->info());
    }
}
