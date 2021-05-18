<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\HistoryController;
use App\Models\History;
use Request;
use Auth;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * change transition
     *
     * 
     */
    public function postIndex(Request $request)
    {
        if (Request::post('list')) {
            // ここに問題一覧ボタン押下時の処理
            $this->list();
        } elseif (Request::post('test')) {
            // ここにテストボタン押下時の処理
            $this->test();
        } elseif ($request::get('history')){
            // ここに履歴ボタン押下時の処理
            $this->history();
        }
    }
    //問題一覧ボタン押下時の処理
    public function list(){
        //ListControllerへ移動
        //return view('');
    }
    //テストボタン押下時の処理
    //public function test(){
        //TestControllerへ移動
        //return view('');
    //}
    //履歴ボタン押下時の処理
    public function history(){
        //ログイン中ユーザーのidを取得
	    $auths = Auth::id();
        //ログイン中ユーザーと紐づく履歴を取得
        $history_list = \App\Models\History::where('user_id', '=', $auths)->get();
        //履歴画面へ遷移
        return view('auth/history',['history_list' => $history_list]);
}
}