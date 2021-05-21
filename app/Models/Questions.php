<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
	use HasFactory;

	protected $table = "questions";
	
	//自動挿入されるcreated_at・updated_atを無効にする
	public $timestamps = false;

	protected $fillable = ['id', 'question', 'created_at', 'updated_at'];

	public function contacts() {

		return $this->hasMany('App\Models\Answers');
	
	}
}
