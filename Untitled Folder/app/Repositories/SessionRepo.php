<?php

namespace App\Repositories;

use App\Models\Session;

class SessionRepo{

	static function all(){
		
		return Session::all();
	}

}

?>