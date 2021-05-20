<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
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
    public function postList(Request $request)
    {
        if ($request->has('register')) {
            //新規登録画面へ遷移
            return view('auth/top/list/register');
        } else{
            //押されたボタンのidを取得
            $id = $request->input('id');
            //データベースよりidの一致する問題と答えを取得
            $questions = DB::table('questions');
            $correct_answers = DB::table('correct_answers');
            $data = DB::select('set @no:=0;');
            $data = DB::select('set @groupid:=null;');
            $data = $questions
                    ->select('questions.id', 'questions.question', 'correct_answers.id as answer_id', 'correct_answers.answer as answer')
                    ->leftJoin('correct_answers', 'questions.id', '=', 'correct_answers.question_id')
                    ->where('questions.id', '=', $id)
                    ->get();
            if ($request->has('edit')) {
                $changes = $data;
                print_r($changes);
                //編集画面へ遷移
                return view('auth/top/list/edit', ['questions' => $questions]);
            } elseif ($request->has('delete')) {
                $deletions = $data;
               //削除画面へ遷移
                return view('auth/top/list/delete',['deletions' => $deletions]);
            }
        }
    }
}