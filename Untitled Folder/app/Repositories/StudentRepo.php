<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepo{

	static function all(){
		
		return Student::all();
	}

}

?>