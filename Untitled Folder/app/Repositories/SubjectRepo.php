<?php

namespace App\Repositories;

use App\Models\Subject;

class SubjectRepo{

	static function all(){
		
		return Subject::all();
	}

	static function create($data)
	{
		return Subject::create($data);
	}
	static function getById($id=null)
	{
		return Subject::findOrFail($id);
	}

	static function delete($id=null)
	{
		return Subject::delete($id);
	}
	static function update($request,$id)
	{
		return Subject::findOrFail($id)->update($request);		
	}
	
	static function deleteMultiple($id=NULL)
	{
		return Subject::whereIn('id',$id)->delete();
		
	}

}

?>