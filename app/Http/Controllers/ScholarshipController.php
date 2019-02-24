<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Runner\ResultCacheExtension;
use App\User;
use App\Http\Controllers\functions;

class ScholarshipController extends Controller
{
    public function create(Request $request)
    {
        // 新規シミュレーションを実行
        var_dump($request->name);                    
    }

    public function history(Request $request)
    {
        // 検索履歴から該当者を表示
        $user = User::where('email', $request->email)->first();

        // ORMによりユーザーに紐づく明細をすべて取得する。
        $meisais = $user->meisais()->orderBy('zankai', 'desc')->get();

        return view('show', [
            'items' => $meisais,
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

}
 
