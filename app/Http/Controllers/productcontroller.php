<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\ProductThumbnails;
use App\Models\subcategory;
use Carbon\Carbon;
use Image;

class productcontroller extends Controller
{
   // add product

   function add_product(){
       $all_category =category::all();
       $all_subcategory= subcategory::all();
       return view('admin.product.add_product', [
           'all_category'=>$all_category,
           'all_subcategory'=>$all_subcategory,
       ]);
   }

   // ajax to controller method and relation category to subcategory--
   function getcategory_ajax(Request $request){
       $data_store = '<option value="">--Select SubCategory--</option>';
       foreach (subcategory::where('category_id', $request->category_id)->get() as $subcategory){
          $data_store .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
       }
       echo $data_store;
   }

   // product Insert----
   function insert_product(ProductRequest $request){
       $insert_product_id = product::insertGetId([
           'category_id'=>$request->category_id,
           'subcategory_id'=>$request->subcategory_id,
           'product_name'=>$request->product_name,
           'product_price'=>$request->product_price,
           'product_discount'=>$request->product_discount,
           'after_discount'=>$request->product_price-$request->product_price*$request->product_discount/100,
           'quantity'=>$request->quantity,
           'short_disc'=>$request->short_discription,
           'long_disc'=>$request->long_discription,
           'created_at'=>Carbon::now(),
       ]);

       //preview Image insert
       $preview_image = $request->preview_image;
       $preview_image_extension = $preview_image->getClientOriginalExtension();
       $preview_image_name = $insert_product_id.'.'.$preview_image_extension;
       Image::make($preview_image)->resize(650,650)->save(public_path('/uplode/product/preview_image/'.$preview_image_name));

       product::find($insert_product_id)->update([
           'preview_image'=>$preview_image_name,
        ]);

       //insert thumbnails Image
        $thumbnails_id = 1;
        foreach ($request->thambnails_image as $thumbnails) {
            $thumbnails_extension = $thumbnails->getClientOriginalExtension();
            $thumbnails_name = $insert_product_id.'-'.$thumbnails_id.'.'.$thumbnails_extension;
            Image::make($thumbnails)->resize(650,650)->save(public_path('/uplode/product/product_Image_thumbnails/'.$thumbnails_name));

            ProductThumbnails::insert([
                'product_id'=>$insert_product_id,
                'thumbnails_name'=>$thumbnails_name,
            ]);
            $thumbnails_id++;
        }


       return back()->with('insert_success', 'Product Insert Successfully ..');

   }

   //view  product----
   function view_product(){
       $all_product = product::all();
       return view('admin.product.view_product', [
           'all_product'=>$all_product,
       ]);
   }

   // delete  product---
   function delete_product($product_id){

    //delete preview image--
      $preview_image = product::where('id', $product_id)->first()->preview_image;
      $delete_preview_image = public_path('/uplode/product/preview_image/'.$preview_image);
      unlink($delete_preview_image);

      //delete thumbnail image---
      $thumbnails_image = ProductThumbnails::where('product_id', $product_id)->get();
      foreach ($thumbnails_image as $thumbnails) {
          $delete_thumbnails_image = public_path('/uplode/product/product_Image_thumbnails/'.$thumbnails->thumbnails_name);
          unlink($delete_thumbnails_image);

      }
      // delete product--
      product::find($product_id)->delete();
      return back()->with('delete_success', 'Product Delete Successfully');

   }

}
