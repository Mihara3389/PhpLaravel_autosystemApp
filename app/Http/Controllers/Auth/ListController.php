<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\ListCommon2;

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
        }else{
            //押されたボタンのidを取得
            $id = $request->input('id');
            //共通処理呼び出し
            $listCommon = new ListCommon2();
            $data = $listCommon->returnList($id);
            if ($request->has('edit')) {
                $changes = $data;
                //編集画面へ遷移
                return view('auth/top/list/edit', compact('changes'));
            } elseif ($request->has('delete')) {
                $deletions = $data;
                //削除画面へ遷移
                return view('auth/top/list/delete',compact('deletions'));
            }
        }
    }
}