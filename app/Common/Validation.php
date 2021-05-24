<?php

namespace app\Common;

use Illuminate\Http\Request;
use Validator;

class Validation
{
    public function rules(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:511',
            'question.0' => 'required|string|max:511',
            'answer.0' => 'required|string|max:255',
            'answer.*' => 'max:255',
        ]);
        return $validator;
    }
}