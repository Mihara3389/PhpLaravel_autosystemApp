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
            //selectで使用する変数の初期値設定
            $lists = DB::select('set @no:=0;');
            $lists = DB::select('set @groupid:=null;');
            //質問全件と質問・答えが一致するものを取得
            //答えがないものはnull
            //questions.id毎に連番付与
            $lists = DB::select
                ('SELECT questions.id as id, questions.question , correct_answers.id as answer_id ,correct_answers.answer as answer,if(@groupid <>  questions.id, @no:=1, @no:=@no+1) as no,@groupid:= questions.id  
                    FROM questions LEFT JOIN correct_answers ON questions.id = correct_answers.question_id');
            //問題一覧画面へ遷移
            return view('auth/top/list',['lists' => $lists]);
        } elseif ($request->has('test')) {
            //質問と答えが紐づく問題のみ取得
            $questions = DB::select('SELECT DISTINCT questions.id as id, questions.question as question FROM questions INNER JOIN correct_answers ON questions.id = correct_answers.question_id;');
            //質問をshuffleする
            shuffle($questions);
            //テスト画面へ遷移
            return view('auth/top/test',['questions' => $questions]);
        } elseif ($request->has('history')){
            //ログイン中ユーザーのidを取得
	        $auths = Auth::id();
            //ログイン中ユーザーと紐づく履歴を取得
            $history_list = \App\Models\History::where('user_id', '=', $auths)->get(); 
            //履歴画面へ遷移
            return view('auth/top/history',['history_list' => $history_list]);
        }
    }
}