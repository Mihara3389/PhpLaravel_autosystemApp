<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
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
    public function postCheck(Request $request)
    {
        if ($request->has('check')) {
            //変数定義
            $all_count = 0;
            $answer_count = 0;
            $correct_count = 0;
            $point = 0;
            $dbanswer_array = [];
            //ログイン中ユーザーのidを取得
	        $auths = Auth::id();
            //現在時刻を取得
            $now = new Carbon(Carbon::now());
            //入力値取得
            $ids = $request->input('id');
            $answers = $request->input('answer');
            //回答チェック
            for ($i = 0 ; $i < count($ids); $i++){
                //問題数カウント
                $all_count = $all_count + 1;
                $db_answers = 
                    \App\Models\Answers::select('question_id', 'answer')->where('question_id', '=', $ids[$i])->get()->toArray();      
                //配列の中から探索
                for ($j = 0 ; $j < count($answers); $j++){
                    if ($i === $j) {
                        foreach($db_answers as $db_answer){
                            if (in_array($answers[$j], $db_answer, true)) {
                                $answer_count = $answer_count + 1;
                                $correct_count = $correct_count + 1;
                            }
                        }
                    }
                }
            }
            //採点
            $point = round(($correct_count / $all_count)*100);
            //採点履歴テーブルへ追加
            $history = new \App\Models\History;
            $history->user_id = $auths;
            $history->point = $point;
            $history->save();
            //採点結果画面へ遷移
            return view('auth/top/test/result', 
                    ['all_count' => $all_count,'correct_count' => $correct_count,'point' => $point,'now' => $now]);
        }
    }
}