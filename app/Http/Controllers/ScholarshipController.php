<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Runner\ResultCacheExtension;
use App\User;
use App\Meisai;

class ScholarshipController extends Controller
{
    public function create(Request $request)
    {
        // 新規シミュレーションを実行
        var_dump($request->name);                    
    }

    public function save(Request $request)
    {
        var_dump($request->items);
        //DBにシミュレーション結果を保存
        $user = User::where('email', $request->email)->first();

        // var_dump($user);
        // 
        //$user->meisais()->delete();

        // $user->meisais()->save((new Meisai([
        //     'zankai' => $request->items->zankai,
        //     'zangaku' => $request->items->zangaku,
        //     'hikibi' => $request->items->hikibi,
        //     'hensaigaku' => $request->items->hensaigaku,
        //     'hensaimoto' => $request->items->hensaimoto,
        //     'suerisoku' => $request->items->suerisoku,
        //     'hasu' => $request->items->hasu,
        //     'atozangaku' => $request->items->atozangaku,
        // ])));

        // ORMによりユーザーに紐づく明細をすべて取得する。
        $meisais = $user->meisais()->orderBy('zankai', 'desc')->get();

        return view('show', [
            'items' => $meisais,
            'name' => $request->name,
            'email' => $request->email,
            'msg' => '保存しました。',
        ]);
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
            'msg' => '',
        ]);
    }

}
 
