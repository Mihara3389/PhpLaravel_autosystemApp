<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\ListCommon;

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
            //共通処理呼び出し
            $listCommon = new ListCommon();
            $lists = $listCommon->returnList();
            if(issert($lists)){
                //新規登録画面へ遷移
                return view('auth/top/list/register');
            }
            return view('auth/top/list', ['lists' => $lists]);
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