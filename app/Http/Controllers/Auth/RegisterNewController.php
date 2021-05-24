<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\ListCommon;
use App\Common\Validation;
use Illuminate\Support\Facades\Validator;

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
            //バリデーション実装
            $Validation = new Validation();
            $validator = $Validation->rules($request);
            // バリデーション（エラーがある場合は前の画面に戻ります）
            if ($validator->fails()) {
                return redirect('redirect/register')
                     ->withErrors($validator)
                     ->withInput();
            }
            //答えの空白&重複チェック
            $bf = [];
            foreach($answers as $answer){
                if(!empty($answer)){
                    if (in_array($answer, $bf,  false)) continue;
                       $registers[] = $answer;
                        $bf[] = $answer;
                }
            }
            //新規登録確認画面へ遷移
            return view('auth/top/list/confirm/register', compact('question', 'registers'));
        }  elseif ($request->has('register')) {
            //表示されている値を取得
            $question = $request->input('question');
            $answers = $request->input('answer');
            //データベースへ登録：問題
            $questions = new \App\Models\Questions;
            $questions->question = $question;
            $questions->created_at = now();
            $questions->save();
            //データベースへ登録：答え
            $data = 
                    \App\Models\Questions::select('id')->where('question', '=', $question)->get()->toArray();      
            $question_id = array_values($data[0]);
            foreach($answers as $answer){
                $answers = new \App\Models\Answers;
                $answers->question_id = $question_id[0];
                $answers->answer = $answer;
                $answers->created_at = now();
                $answers->save();      
            }
            //問題一覧画面へ遷移
            $listCommon = new ListCommon();
            $lists = $listCommon->returnList();
            return view('auth/top/list', compact('lists'));
        }elseif ($request->has('return_list')) {
            //問題一覧画面へ遷移
            $listCommon = new ListCommon();
            $lists = $listCommon->returnList();
            return view('auth/top/list', compact('lists'));
        }elseif ($request->has('return_register')) {
             //新規登録画面へ遷移
             return view('auth/top/list/register');
        }
    }
}
