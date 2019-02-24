<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Runner\ResultCacheExtension;
use App\User;
use App\Meisai;
use Illuminate\Support\Facades\View;
use Symfony\Component\VarDumper\VarDumper;

class ScholarshipController extends Controller
{
    public function make(Request $request)
    {
        var_dump($request->finyear);
    }

    /**
     * setting画面を表示
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        return view('setting', [
            'email' => $request->email,
            'name' => $request->name,
        ]);                
    }

    /**
     * 保存処理（削除予定）
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        // var_dump($request->items);

        // emailからUserを取得する。
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

    /**
     * 履歴から奨学金のシミュレーション結果を取得
     *
     * @param Request $request
     * @return void
     */
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
 
