<?php

namespace App\Repositories;

use App\Models\SessionSubject;

class SessionSubjectRepo{

	static function all(){
		
		return SessionSubject::all();
	}

}

?>