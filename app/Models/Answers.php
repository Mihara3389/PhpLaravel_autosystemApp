<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
	use HasFactory;

	protected $table = "correct_answers";
	
	protected $fillable = ['id', 'question_id', 'answer', 'created_at', 'updated_at'];
}
