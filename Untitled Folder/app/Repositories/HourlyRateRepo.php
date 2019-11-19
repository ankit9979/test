<?php

namespace App\Repositories;

use App\Models\HourlyRate;

class HourlyRateRepo{

	static function all(){
		
		return HourlyRate::all();
	}

}

?>