<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = [

		'name',
		'surname',
		'high_school_grade',
		'session_group',
		'learning_diff'

	];
}
