<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\ListCommon;

class DeleteController extends Controller
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
    public function postDelete(Request $request)
    {
        if ($request->has('delete')) {
            //入力値取得
            $id = $request->input('id');
            //削除処理実行:Questions
            $questions = new \App\Models\Questions;
            $questions->where('id', $id)->delete();
            //削除処理実行:Answers
            $answers = new \App\Models\Answers;
            $answers->where('question_id', $id)->delete();
            //問題一覧画面へ遷移
            $listCommon = new ListCommon();
            $lists = $listCommon->returnList();
            if (empty($lists)) {
                //新規登録画面へ遷移
                return view('auth/top/list/register');
            }else{
                return view('auth/top/list',compact('lists'));
            }
        }else if ($request->has('return_list')) {
            //問題一覧画面へ遷移
            $listCommon = new ListCommon();
            $lists = $listCommon->returnList();
            return view('auth/top/list', compact('lists'));
        }
    }
}