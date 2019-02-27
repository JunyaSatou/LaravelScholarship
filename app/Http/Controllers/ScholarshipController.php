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
     * ユーザーの明細をすべて表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        $meisais = $user->meisais()->paginate(15);

        return view('show', [
            'email' => $request->email,
            'name' => $request->name,
            'items' => $meisais,
            'msg' => '',
        ]);
    }

    /**
     * 新規シミュレーションを行う
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function create(Request $request)
    {
        // 「シミュレーション開始」の処理
        // バリデーション
        $request->validate([
            'goukei' => 'required|integer',
            'finyear' => 'required|integer',
            'finmonth' => 'required|integer',
            'nenri' => 'required|numeric',
        ], [
            'goukei.required' => '借用金額を入力してください',
            'goukei.integer' => '整数を入力してください',
            'finyear.required' => '借用終了年を入力してください',
            'finyear.integer' => '整数を入力してください',
            'finmonth.required' => '借用終了月を入力してください',
            'finmonth.integer' => '整数を入力してください',
            'nenri.required' => '年利を入力してください',
            'nenri.numeric' => '数値を入力してください',
        ]);

        // emailからUserを取得する。
        $user = User::where('email', $request->email)->first();

        // 過去のシミュレーション結果を削除
        $user->meisais()->delete();

        // シミュレーションを実施
        $scholarship = new Scholarship($request->email, $request->goukei, $request->nenri, $request->finyear, $request->finmonth);
        $scholarship->calcurateItems();
        $scholarship->hensaiSimulation();

        return redirect()->action('ScholarshipController@index', ['name' => $request->name, 'email' => $request->email]);
    }

    public function detail(Request $request)
    {
        $meisai = Meisai::where('id', $request->id)->first();

        return view('detail', [
            'email' => $request->email,
            'name' => $request->name,
            'item' => $meisai,
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
}
 
