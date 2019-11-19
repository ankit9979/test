<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SubjectRepo;
class SubjectController extends Controller
{
	public function __construct()
	{   $this->middleware('role:ADMIN');
	$this->middleware('auth');
}
public function index()
{
	$subjects = SubjectRepo::all();       
	return view('admin.subject.list',compact('subjects'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.subject.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$input = $request->all();

    	SubjectRepo::create($input);        
    	$request->session()->flash('alert-success', 'Brand added successfully!');
    	return redirect()->route('subjects.index');
    }

    public function edit($id)
    {
    	$subject = SubjectRepo::getById($id);        
    	return view('admin.subject.edit',compact('subject'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$input = $request->all();
      
    	SubjectRepo::udpate($input,$id); 
    	$request->session()->flash('alert-success', 'Subject updated successfully!');
    	return redirect()->route('subjects.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {      
    	SubjectRepo::delete($id);  
    	session()->flash('alert-success', 'Brand successfully deleted!');
    	return redirect()->route('subjects.index');
    }
    public function deleteMultiple(Request $request)
    {
    	$input = $request->all();
    	$delete = array_filter(explode(',', $input['delete']));    
    	
    	if(empty( $delete)){
    		session()->flash('alert-danger', 'Please select atleast one checkbox!');
    		return redirect()->back();
    	}

    	SubjectRepo::deleteMultiple($delete);  
    	session()->flash('alert-success', 'Brand successfully deleted!');
    	return redirect()->back();
    }
}
