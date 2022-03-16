<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class subcategorycontroller extends Controller
{
    // add subcategory page view
    function add_subcategory(){
       $all_category = category::all();
        return view('admin.subcategory.add_subcategory', compact('all_category'));
        }

    //insert subcategory
    function insert_subcategory(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required',
            'subcategory_image'=>'required',
        ],[
            'category_id.required'=>"* Please Select Your Category Name",
            'subcategory_name.required'=>"* This Field Is Required",
            'subcategory_image.required'=>"* Please Select Your SubCategory Image",
        ]);

        // condition : ekti category r undare same subcategory 2er odik thakbe na.. kintu same subcategory onno category te thakte parbe...

        if(subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()){
           return back()->with('exists', 'Subcategory Already Exists in Selected Category');
        }
        else{
                //insert
            $subcategory_insert_id = subcategory::insertGetId([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'added_by'=>Auth::id(),
                'created_at'=>Carbon::now(),
            ]);
            //insert image and save file
             $subcategory_image = $request->subcategory_image;
             $image_extension = $subcategory_image->getClientOriginalExtension();
             $image_new_name = $subcategory_insert_id.'.'.$image_extension;
             Image::make($subcategory_image)->save(public_path('/uplode/subcategory/'.$image_new_name));

             subcategory::find($subcategory_insert_id)->update([
                'subcategory_image'=>$image_new_name,
             ]);
            return back()->with('subcategory_success', 'Subcategory Insert Successfully...');
            }
    }

    // view subcategory
    function view_subcategory(){
        $all_subcategory = subcategory::all();
         return view('admin.subcategory.view_subcategory', compact('all_subcategory'));
         }
    // edit_subcategory
    function edit_subcategory($subcategory_id){
        $all_category = category::all();
        $subcategory_id_allinfo = subcategory::find($subcategory_id);
        return view('admin.subcategory.edit_subcategory', compact('subcategory_id_allinfo', 'all_category'));
    }

    // update subcategory
    function update_subcategory(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required',
        ],[
            'category_id.required'=>"* Please Select Your Category Name",
            'subcategory_name.required'=>"* This Field Is Required",
        ]);

    // condition : ekti category r undare same subcategory 2er odik thakbe na.. kintu same subcategory onno category te thakte parbe...
    if(subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()){
        return back()->with('exist', 'Category Name Already Exists in Selected Category');
    }
    else{
        //if image empty then update
       if($request->subcategory_image == ''){
           subcategory::find($request->subcategory_id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,

           ]);
       }
       //image not empty then update
       else{
          // unlink subcategory  image
           $subcategory_image_id= subcategory::find($request->subcategory_id);
           $subcategory_image_name = $subcategory_image_id->subcategory_image;
           $delete_location = public_path('/uplode/subcategory/'.$subcategory_image_name);
           unlink($delete_location);

           // new subcategory image location
           $subcategory_image = $request->subcategory_image;
           $subcategory_image_extension = $subcategory_image->getClientOriginalExtension();
           $image_new_name = $request->subcategory_id.'.'.$subcategory_image_extension;
           Image::make($subcategory_image)->save(public_path('/uplode/subcategory/'.$image_new_name));
           subcategory::find($request->subcategory_id)->update([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'subcategory_image'=>$image_new_name,
           ]);


        }
      }
      return back();

    }

}
