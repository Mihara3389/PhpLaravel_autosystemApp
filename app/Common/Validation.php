<?php

namespace app\Common;

use Illuminate\Http\Request;
use Validator;

class Validation
{
    public function rules(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:511|unique:questions,question',
            'answer.0' => 'required|max:255',
            'answer.*' => 'max:255',
        ]);
        return $validator;
    }
}