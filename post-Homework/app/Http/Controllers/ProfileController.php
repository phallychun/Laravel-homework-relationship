<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Profile::latest()->get();
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
            'user_id'=>'required',
            'image'=>'image|mines:jpg,png,gif,PNG|max:1999',
            'city'=>'required'
        ]);
        // upload img to storage file
        $request->file('image')->store('public/images');
        // Get original image name
        $originalName = $request->file('image')->getClientOriginalName();
        //
        $profile = new Pofile();
        $porfile->user_id = $request->user_id;
        $porfile->image = $request->file('image')->hashName();
        $porfile->city = $request->city;
        $porfile->save();

        return response()->json('Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Profile::findOrFail($id);
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
        $request->validate([
            "user_id"=>"required",
            "image"=>"image|mimes: png,jpg,jpeg,gif|max:1999",
            "city"=>"required"
        ]);
        //move image to storage
        $request->file('image')->store('public/images');

        $profile = Profile::findOrFail($id);
        $profile->user_id = $request->user_id;
        $profile->image = $request->file('image')->hashName();
        $profile->city = $request->city;
        $profile->save();
        return response()->json("Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::destroy($id);
        if($profile == 1){
            return response()->json("Deleted");
        }else{
            return response()->json("Can not delete empty data");
        }
    }
}
