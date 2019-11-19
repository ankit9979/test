<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
	protected $fillable = [
		'session_name', 'start_date', 'end_date',
		'no_of_session', 'total_amn'
	];
}
