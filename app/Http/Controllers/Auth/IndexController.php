<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Request;

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

    //履歴ボタン押下時の処理
    public function history(){
        //履歴テーブルを取得

        //画面へ戻す値を詰める
        //取得した値を履歴画面へ遷移
        return view('auth/history');
    }
}