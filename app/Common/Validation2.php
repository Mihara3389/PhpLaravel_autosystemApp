<?php

namespace app\Common;

use Illuminate\Http\Request;
use Validator;

class Validation2
{
    public function rules(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question.*' => 'required|max:511',
            'answer.0' => 'required|max:255',
            'answer.*' => 'max:255',
        ]);
        return $validator;
    }
}