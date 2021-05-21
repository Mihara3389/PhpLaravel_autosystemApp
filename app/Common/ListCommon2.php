<?php

namespace app\Common;

use Illuminate\Support\Facades\DB;

class ListCommon2
{
    public static function returnList(String $id)
    {
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
        return $data;
    }
}