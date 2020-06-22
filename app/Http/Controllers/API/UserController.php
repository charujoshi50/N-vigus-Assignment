<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
		'name'=>'required|string|max:191',
		'email'=>'required|string|max:191|unique:users',
		'password'=>'required|min:6'
		
		]);
		
        $request->password=Hash::make($request->password);
		$user= new User;
		$user->name=$request->name;
		$user->email=$request->email;
		$user->type=$request->type;
		$user->bio=$request->bio;
		$user->password=$request->password;
		$user->save();
		
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
	
	   /**
     * this is the profile .
     */
	 public function Profile(Request $request){
		$user_no= $request->user;
		return User::where('id',$user_no)->get();
			
	
		 
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
		$user=User::findOrFail($id);
		if(!empty($request->password)){
				$user->name=$request->name;
				$user->email=$request->email;
				$user->type=$request->type;
				$user->bio=$request->bio;
				$user->password=Hash::make($request->password);
				$user->save();
			
		}
				$user->name=$request->name;
				$user->email=$request->email;
				$user->type=$request->type;
				$user->bio=$request->bio;
				$user->save();
		
		
		
		
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $user= User::findOrFail($id);
		$user->delete();
		
}

		
		
    }