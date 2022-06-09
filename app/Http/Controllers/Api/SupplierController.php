<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:suppliers',
        ]);


  
        $data = array();
        // $name = $request->name;
        $image = $request->image;
    
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['shopname'] = $request->shopname;
        $data['address'] = $request->address;
      
        
     $image=  $request->file('image')->store('1XXV5-LUGp5lzmqUdyTvg7MHg7cCZ8lhT','google');
     $data['photo'] = Storage::disk('google')->url($image);
  
       Supplier::create($data);



        // if($request->photo){
        //     $position = strpos($request->photo, ';');
        //     $sub = substr($request->photo, 0,$position);
        //     $ext = explode('/',$sub)[1];

        //     $name = time().".".$ext;
        //     //using image intervention added package to resize the image
        //     $img = Image::make($request->photo)->resize(240,200);
        //     $upload_path = 'backend/supplier/';
        //     $image_url = $upload_path.$name;

        //     $img->save($image_url);
           
        //     //saving data with image

        //     $supplier = new Supplier;
        //     $supplier->name = $request->name;
        //     $supplier->email = $request->email;
        //     $supplier->phone = $request->phone;
        //     $supplier->shopname = $request->shopname;
        //     $supplier->address = $request->address;
          
        //     $supplier->photo = $image_url;
        //     $supplier->save();

        // }
        // else{

        //    //saving data without image

        //     $supplier = new Supplier;
        //     $supplier->name = $request->name;
        //     $supplier->email = $request->email;
        //     $supplier->phone = $request->phone;
        //     $supplier->shopname = $request->shopname;
        //     $supplier->address = $request->address;
           
        //     $supplier->save();
        // }
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
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       
        //
         //
         $data = array();
         $data['name'] = $request->name;
         $data['email'] = $request->email;
         $data['phone'] = $request->phone;
         $data['shopname'] = $request->shopname;
         $data['address'] = $request->address;
        
        $image = $request->newphoto;
 
        if($image){
         $position = strpos($image, ';');
         $sub = substr($image, 0,$position);
         $ext = explode('/',$sub)[1];
 
         $name = time().".".$ext;
         //using image intervention added package to resize the image
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/supplier/';
         $image_url = $upload_path.$name;
        $success = $img->save($image_url);
 
        //update with new image
        if($success){
            //accessing the old photo form data
            $data['photo'] = $image_url;
            //searching the employees table for the employee with the given request id
            $img = DB::table('suppliers')->where('id',$id)->first();
            //selecting the photo filed of the employee database for the returned employee belonging to the request id above 
            $img_path = $img->photo;
            //unlinking the old image in the server image folder
            $done = unlink($img_path);
            //updating the employees table with the new data & the new photo
           DB::table('suppliers')->where('id',$id)->update($data);
        }
        //else if no new image found in the returned form data update with the employees table wth the old image
        }else {
            //use the photo data of the form for the old image data
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
             DB::table('suppliers')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        $photo = $supplier->photo;
        if($photo){
            unlink($photo);
            DB::table('suppliers')->where('id',$id)->delete();

        }else{
            DB::table('suppliers')->where('id',$id)->delete();

        }
    }
}
