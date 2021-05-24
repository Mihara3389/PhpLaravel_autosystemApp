<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\ListCommon;
use App\Common\ListCommon2;
use App\Common\Validation;
use Validator;

class EditController extends Controller
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
    public function postEdit(Request $request)
    {
        if ($request->has('check')) {
            //入力値取得
            $id_aray = $request->input('id');
            $id = $id_aray[0];
            $question_aray = $request->input('question');
            $question = $question_aray[0];
            $answer_ids = $request->input('answer_id');
            $answers = $request->input('answer');
            //セッションへidを格納
            $request->session()->put('key', $id);
            //バリデーション実装
            $Validation = new Validation();
            $validator = $Validation->rules($request);
            // バリデーション（エラーがある場合は前の画面に戻ります）
            if ($validator->fails()) {
                return redirect('redirect/edit')
                     ->withErrors($validator)
                     ->withInput();
            }
            //答えの空白&重複チェック
            $bf = "";
            if (!empty($answer_ids)) {
                for ($i = 0; $i < count($answer_ids); ++$i) {
                    for ($j = 0; $j < count($answers); ++$j) {
                        if ($i !== $j) continue;
                            if  (empty($answers[$j])) continue;
                                if ($bf === $answers[$j]) continue;
                                    $aid_list[] = $answer_ids[$i];
                                    $answer_list[] = $answers[$j];
                                    $bf = $answers[$j];
                    }
                }
                //編集確認画面へ遷移
                return view('auth/top/list/confirm/edit', compact('id','question', 'aid_list', 'answer_list'));
            }else{
                //編集確認画面へ遷移
                return view('auth/top/list/confirm/edit', compact('id','question'));
            }   
        }  elseif ($request->has('update')) {
            //表示されている値を取得
            $id = $request->input('id');
            $question = $request->input('question');
            $answer_ids = $request->input('answer_id');
            $answers = $request->input('answer');
            //データベースへ更新：問題
            $questions = new \App\Models\Questions;
            $questions = \App\Models\Questions::find($id);
            $questions->question = $question;
            $questions->updated_at = now();
            $questions->save();
            //問題idに一致する答えを全件取得する
            $answer_db = new \App\Models\Answers;
            $answer_db = \App\Models\Answers::select('id')->where('question_id', '=', $id)->get()->toArray();   
            //編集画面にて削除された答えをデータベースにも反映
            for ($a = 0; $a < count($answer_db); ++$a) {
                $answer_array = $answer_db[$a];
                $answer_all[] = $answer_array['id'];
            }
            if (!empty($answer_all)) {
                for ($i = 0; $i < count($answer_all); ++$i) {
                    //削除フラグ
                    $delete_flg = 0;
                    $all = $answer_all[$i];
                    for ($j = 0; $j < count($answer_ids); ++$j) {
                        $aid = $answer_ids[$j];  
                        if (strcmp($all, $aid) == 0 or strcmp($aid, 'new') == 0) {
                            $delete_flg = 1;
                            break;
                        }
                    }
                    if ($delete_flg === 0) {
                        //文字列変換
                        $qid = (int)$all;
                        //削除実行
                        $correct_answers = new \App\Models\Answers;
                        $correct_answers->where('id', $all)->delete();
                    }
                }
            }
            //データベースへ更新：答え
            for ($k = 0; $k < count($answer_ids); ++$k) {
                for ($l = 0; $l < count($answers); ++$l) {
                    if ($k !== $l) continue;
                        if (strcmp($answer_ids[$k], 'new') == 0) {
                            $correct_answers = new \App\Models\Answers;
                            $correct_answers->question_id = $id;
                            $correct_answers->answer = $answers[$l];
                            $correct_answers->created_at = now();
                            $correct_answers->save();   
                        } else {
                            $correct_answers = new \App\Models\Answers;
                            $correct_answers = \App\Models\Answers::find($answer_ids[$k]);
                            $correct_answers->answer = $answers[$l];
                            $correct_answers->updated_at = now();
                            $correct_answers->save();  
                        }
                }
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
        }elseif ($request->has('return_edit')) {
            //idを取得
            $id = $request->input('id');
            //共通処理呼び出し
            $listCommon = new ListCommon2();
            $data = $listCommon->returnList($id);
            //編集画面へ遷移
            $changes = $data;
            return view('auth/top/list/edit', ['changes' => $changes]);
       
        }
    }
}
