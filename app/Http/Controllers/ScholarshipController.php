<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Runner\ResultCacheExtension;
use App\User;
use App\Meisai;
use App\Scholarship;
use Illuminate\Support\Facades\View;
use Symfony\Component\VarDumper\VarDumper;
use App\Http\Requests\SettingRequest;

class ScholarshipController extends Controller
{
    /**
     * @param SettingRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function create(SettingRequest $request)
    {

        // emailからUserを取得する。
        $user = User::where('email', $request->email)->first();

        $user->meisais()->delete();

        $scholarship = new Scholarship($request->email, $request->goukei, $request->nenri, $request->finyear, $request->finmonth);
        $scholarship->calcurateItems();
        $scholarship->hensaiSimulation();

//        $meisais = $user->meisais()->orderBy('zankai', 'desc')->get();
        $meisais = $user->meisais()->get();

        return view('show',[
            'email' => $request->email,
            'name' => $request->name,
            'items' => $meisais,
            'msg' => '',
        ]);
    }

    /**
     * setting画面を表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting(Request $request)
    {
        return view('setting', [
            'email' => $request->email,
            'name' => $request->name,
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
//        $meisais = $user->meisais()->orderBy('zankai', 'desc')->get();
        $meisais = $user->meisais()->get();

        return view('show', [
            'items' => $meisais,
            'name' => $request->name,
            'email' => $request->email,
            'msg' => '',
        ]);
    }

}
 
