<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
	use HasFactory;

	//自動挿入されるcreated_at・updated_atを無効にする
	public $timestamps = false;

	protected $table = "correct_answers";
	
	protected $fillable = ['id', 'question_id', 'answer', 'created_at', 'updated_at'];
}
