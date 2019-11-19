<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amanuensis extends Model
{
	protected $fillable = [
		'user_id',
		'name', 
		'surname',
		'mobile_no',
		'gender',
		'lang_pro_1',
		'lang_pro_2',
		'lang_pro_3',
		'have_drv_licence',
		'have_car',
		'qualification',
		'study_dir',
		'bio',
		'cv',
		'passport',
		'driver_licence',
		'bank_name',
		'bank_type',
		'account_type',
		'account_number',
		'branch_code',
		'is_new',
		'is_interviewed',
		'is_shadowing',
		'is_contract_signed',
		'is_approved',
		'hourly_rate'
	];
}
