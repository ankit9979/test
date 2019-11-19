<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepo{

	static function all(){
		
		return Service::all();
	}

}

?>