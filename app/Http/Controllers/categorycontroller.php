<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use Illuminate\Http\Request;
use App\Models\category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class categorycontroller extends Controller
{
    function add_category(){
       return view('admin.category.add_category');
    }

    //insert category
    function category_insert(categoryRequest $request){
       $category_id= category::insertGetId([
            'category_name'=>$request->category_name,
            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);

        //category image insert
        $category_image = $request->category_image;
        $image_extension = $category_image->getClientOriginalExtension();
        $image_name = $category_id.'.'.$image_extension;
        Image::make($category_image)->save(public_path('/uplode/category/'.$image_name));
        category::find($category_id)->update([
            'category_image'=>$image_name,
        ]);
        return back()->with('insert_success', 'Category Insert successfully');


    }
    //view category
    function view_category(){
        $all_category =category::all();
        return view('admin.category.view_category', compact('all_category'));
    }
    //category_softDelete
    function category_softDelete($category_id){
        category::find($category_id)->delete();
        return back()->with('remove_success', 'Category Remove Successfully..');
    }
    //trashed_category
    function trashed_category(){
        $all_trashedcategory = category::onlyTrashed()->get();
        return view('admin.category.trashed_category', compact('all_trashedcategory'));
    }
    //forcedelete_category
    function forcedelete_category($category_id){
        $category_id2 =category::onlyTrashed()->find($category_id);
        $cat_image_name = $category_id2->category_image;
        $image_delete_location = public_path('/uplode/category/'.$cat_image_name);
        unlink($image_delete_location);
        category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->with('delete_success', 'Category Delete Successfully..');

    }
    //restore category
    function restore_category($category_id){
       category::onlyTrashed()->find($category_id)->restore();
       return back()->with('restore_success', 'Category Restore Successfully...');
    }

    //edit Category
    function edit_category($category_id){
        $category_id_info =category::find($category_id);
        return view('admin.category.edit_category', compact('category_id_info'));
    }

    // update category
    function update_category(Request $request){
        if($request->category_image == ''){
            category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
            ]);
        }
        else{
            //unlink image----
            $image_category_id =category::find($request->category_id);
            $category_image_name=$image_category_id->category_image;
            $cat_image_delete = public_path('/uplode/category/'.$category_image_name);
            unlink($cat_image_delete);

            //update and new image location
            $category_image = $request->category_image;
            $image_extension = $category_image->getClientOriginalExtension();
            $image_name = $request->category_id.'.'.$image_extension;
            Image::make($category_image)->save(public_path('/uplode/category/'.$image_name));
            category::find($request->category_id)->update([
                'category_name'=>$request->category_name,
                'category_image'=>$image_name,
            ]);

        }
        return back();
    }
}
