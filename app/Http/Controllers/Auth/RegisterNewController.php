<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\ListCommon;

class RegisterNewController extends Controller
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
    public function postRegister(Request $request)
    {
        if ($request->has('check')) {
            //入力値取得
            $question = $request->input('question');
            $answers = $request->input('answer');
            //答えの空白&重複チェック
            $bf = "";
            foreach($answers as $answer){
                if(!empty($answer)){
                    if($bf === $answer){
                    }else{
                        $registers[] = $answer;
                        $bf = $answer;
                    }
                }
            }
            return view('auth/top/list/confirm/register', compact('question', 'registers'));
            //新規登録確認画面へ遷移
            //return view('auth/top/list/confirm/register',['question' => $question, 'registers' => $registers]);
        }  elseif ($request->has('register')) {
            //表示されている値を取得
            $question = $request->input('question');
            $answers = $request->input('answer');
            //データベースへ登録：問題
            $questions = new \App\Models\Questions;
            $questions->question = $question;
            $questions->save();
            //データベースへ登録：問題
            $data = 
                    \App\Models\Questions::select('id')->where('question', '=', $question)->get()->toArray();      
            $question_id = array_values($data[0]);
            foreach($answers as $answer){
                $answers = new \App\Models\Answers;
                $answers->question_id = $question_id[0];
                $answers->answer = $answer;
                $answers->save();      
            }
            //問題一覧画面へ遷移
            $listCommon = new ListCommon();
            $lists = $listCommon->returnList();
            return view('auth/top/list', ['lists' => $lists]);
        }elseif ($request->has('return_list')) {
            //問題一覧画面へ遷移
            $listCommon = new ListCommon();
            $lists = $listCommon->returnList();
            return view('auth/top/list', ['lists' => $lists]);
        }elseif ($request->has('return_register')) {
             //新規登録画面へ遷移
             return view('auth/top/list/register');
        }
    }
}