<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Post;

class HistoryController extends Controller
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

    public function index()
    {
        return view('auth/history');
    }


}