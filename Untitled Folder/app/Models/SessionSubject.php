<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SessionSubject extends Model
{
	protected $fillable = [
		'session_id', 'subject_id', 'examin_date',
		'start_time', 'end_time', 'total_time',
		'total_amn', 'total_paper'
	];
}
