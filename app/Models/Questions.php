<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
	use HasFactory;

	protected $table = "questions";
	
	protected $fillable = ['id', 'question', 'created_at', 'updated_at'];

	public function contacts() {

		return $this->hasMany('App\Models\Answers');
	
	}
}
