<?php

namespace App\Http\Controllers\Ajax;

use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function Psy\debug;

class ScholarshipController extends Controller
{
    public function delete(Request $request){

        $request->all();

        $request->header('content-type');

        $request->isJson();

//        Log::info($request->searchID);
//        var_dump();
        // メールを送信する
//        return response()->json([
//          'result' => true
//        ]);
        // emailからUserを取得する。
        $user = User::where('email', $email)->first();

        // Userの指定された明細IDのレコードを削除
        $user->meisais()->where('meisai_id', $searchID)->delete();

        return redirect()->action('ScholarshipController@index', ['name' => $name, 'email' => $email]);
    }
}
