<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
	use HasFactory;

	//自動挿入されるupdated_atを無効にする
	const UPDATED_AT = NULL;

	protected $table = "histories";
	
	protected $fillable = ['id', 'user_id', 'point', 'created_at'];
}
