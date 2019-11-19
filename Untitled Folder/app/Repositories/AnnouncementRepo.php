<?php

namespace App\Repositories;

use App\Models\Announcement;

class AnnouncementRepo{

	static function all(){
		
		return Announcement::all();
	}

}

?>