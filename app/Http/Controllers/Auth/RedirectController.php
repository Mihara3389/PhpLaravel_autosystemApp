<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\ListCommon2;

class RedirectController extends Controller
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
    public function indexRegister(Request $request)
    {
        //新規登録画面へ遷移
        return view('auth/top/list/register');
    }

    public function indexEdit(Request $request)
    {
        //セッションよりidを取得
        $id = $request->session()->get('key');
        //セッションより削除
        $request->session()->forget('key'); 
        //共通処理呼び出し
        $listCommon = new ListCommon2();
        $data = $listCommon->returnList($id);
        //編集画面へ遷移
        $changes = $data;
        return view('auth/top/list/edit',compact('changes'));
    }
}