<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth/top');
    }

     /**
     * change transition
     *
     * 
     */
    public function postIndex(Request $request)
    {
        if ($request->has('list')) {
            // ここに問題一覧ボタン押下時の処理
            $this->list();
        } elseif ($request->has('test')) {
            // ここにテストボタン押下時の処理
            $this->test();
        } elseif ($request->has('history')){
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
    public function test(){
        //質問と答えが紐づく問題のみ取得
        $questions = DB::select('SELECT DISTINCT questions.id as id, questions.question as question FROM questions INNER JOIN correct_answers ON questions.id = correct_answers.question_id;');
        //質問をshuffleする
        shuffle($questions);
        //テスト画面へ遷移
        return view('auth/top/test',['questions' => $questions]);
    }
    //履歴ボタン押下時の処理
    public function history(Request $history_list){
        //ログイン中ユーザーのidを取得
	    $auths = Auth::id();
        //ログイン中ユーザーと紐づく履歴を取得
        $history_list = \App\Models\History::where('user_id', '=', $auths)->get(); 
        //履歴画面へ遷移
        return view('auth/top/history',['history_list' => $history_list]);
    }
}