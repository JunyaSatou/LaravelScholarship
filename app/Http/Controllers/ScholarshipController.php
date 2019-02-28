<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use mysql_xdevapi\Exception;
use PHPUnit\Runner\ResultCacheExtension;
use Illuminate\Database\Eloquent\Collection;
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

        // 明細のIDが指定されているとき
        if (isset($request->searchID)) {
            $maxID = $request->searchID;
            $minID = $request->searchID;
        } else {
            $maxID = $user->meisais()->max('id');
            $minID = $user->meisais()->min('id');
        }

        if(isset($maxID) && isset($minID)){
            $meisais = $user->meisais()->moreThan($minID)->lessThan($maxID)->paginate(15);
        }
        else{
            $meisais = $user->meisais()->get();
        }

        return view('show', [
            'email' => $request->email,
            'name' => $request->name,
            'title' => $request->title,
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
        $this->validate($request, [
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

        return redirect()->action('ScholarshipController@index', ['name' => $request->name, 'email' => $request->email, 'title' => $request->title]);
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
     * 削除ボタンが押下されたときに明細を削除する。
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        Meisai::where('id', $request->id)->delete();

        return redirect()->action('ScholarshipController@index', ['name' => $request->name, 'email' => $request->email, 'title' => $request->title]);
    }

    /**
     * meisaisテーブルの情報をCSVに吐き出す
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function csv(Request $request)
    {
        $fileName = '明細' . '.csv';

        $csvFileName = "/Users/junya_sato/Downloads/" . $fileName;

        $res = fopen($csvFileName, 'w');

        if ($res === FALSE) throw new Exception('ファイルの書き込みに失敗しました。');

        $csvHeader = array('明細ID', '残り回数', '残額', '引落日', '返済金額', '返済元金', '据置利息', '利息', '端数', '引落後残額');

        fputcsv($res, $csvHeader);

        $user = User::where('email', $request->email)->first();

        // 明細のIDが指定されているとき
        if (isset($request->searchID)) {
            $maxID = $request->searchID;
            $minID = $request->searchID;
        } else {
            $maxID = $user->meisais()->max('id');
            $minID = $user->meisais()->min('id');
        }

        $meisais = $user->meisais()->moreThan($minID)->lessThan($maxID)->get();

        foreach ($meisais as $meisai) {
            fputcsv($res, [$meisai->meisai_id, $meisai->zankai, $meisai->zangaku, $meisai->hikibi, $meisai->hensaigaku, $meisai->hensaimoto, $meisai->suerisoku, $meisai->risoku, $meisai->hasu, $meisai->atozangaku,]);
        }

        fclose($res);

        return Response::download($csvFileName, $fileName);
    }

    public function search(Request $request){
        $this->validate($request, [
            'input' => 'required'
        ],[
            'input.required' => '検索条件が入力されていません'
        ]);

        // emailからUserを取得する。
        $user = User::where('email', $request->email)->first();

        $meisais = $user->meisais()->usefulEquals($request->kensakuItem, $request->input, $request->joken)->paginate(15);

        return view('show', [
            'email' => $request->email,
            'name' => $request->name,
            'title' => $request->title,
            'items' => $meisais,
            'msg' => '',
        ]);
    }
}
 
