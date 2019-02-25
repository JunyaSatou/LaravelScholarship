<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Runner\ResultCacheExtension;
use App\User;
use App\Meisai;
use Illuminate\Support\Facades\View;
use Symfony\Component\VarDumper\VarDumper;
use App\Http\Requests\ScholarshipRequest;

class ScholarshipController extends Controller
{
    public function make(ScholarshipRequest $request)
    {
        var_dump($request);

//        // emailからUserを取得する。
//        $user = User::where('email', $request->email)->first();
//
//        $user->meisais()->save((new Meisai)->fill([
//            'zankai' => '2回',
//            'zangaku' => '16,270円',
//            'hikibi' => '2018年4月27日',
//            'hensaigaku' => '16,270円',
//            'hensaimoto' => '16,170円',
//            'suerisoku' => '3円',
//            'risoku' => '97円',
//            'hasu' => '0円',
//            'atozangaku' => '0円',
//        ]));
//
//        $meisais = $user->meisais()->get();
//
//        return view('show',[
//            'email' => $request->email,
//            'name' => $request->name,
//            'items' => $meisais,
//            'msg' => '',
//        ]);
    }

    /**
     * setting画面を表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
 
