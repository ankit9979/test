<?php

namespace App\Repositories;

use App\Models\Amanuensis;

class AmanuensisRepo{

	static function all(){
		
		return Amanuensis::all();
	}

}

?>