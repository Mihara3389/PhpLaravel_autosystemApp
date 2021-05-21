<?php

namespace app\Common;

use Illuminate\Support\Facades\DB;

class ListCommon
{
    public static function returnList()
    {
        //selectで使用する変数の初期値設定
        $lists = DB::select('set @no:=0;');
        $lists = DB::select('set @groupid:=null;');
        //質問全件と質問・答えが一致するものを取得
        //答えがないものはnull
        //questions.id毎に連番付与
        $lists = DB::select('SELECT questions.id as id, questions.question , correct_answers.id as answer_id ,correct_answers.answer as answer,if(@groupid <>  questions.id, @no:=1, @no:=@no+1) as no,@groupid:= questions.id  
        FROM questions LEFT JOIN correct_answers ON questions.id = correct_answers.question_id'); 
        return $lists;
    }
}