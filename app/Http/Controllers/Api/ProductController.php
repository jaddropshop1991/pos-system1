<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Image;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $product = DB::table('products') 
        // ->join('categories','products.category_id','categories.id')
        // ->join('suppliers','products.supplier_id','suppliers.id')
        // ->select('categories.category_name', 'suppliers.name','products.*')
        // ->orderBy('products.id','DESC')
        // ->get();
        // return response()->json($product);

        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('suppliers','products.supplier_id','suppliers.id')
        ->select('categories.category_name','suppliers.name','products.*')
        ->orderBy('products.id','DESC')
        ->get();
        return response()->json($product);
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
        // $validateData = $request->validate([
        //     'product_name' => 'required|max:255',
        //     'product_code' => 'required|unique:products',
        //     'category_id' => 'required',
        //     'supplier_id' => 'required',
        //     'buying_price' => 'required',
        //     'selling_price' => 'required',
        //     'buying_date' => 'required',
        //     'product_quantity' => 'required',


        // ]);

        // if($request->image){
        //     $position = strpos($request->image, ';');
        //     $sub = substr($request->image, 0,$position);
        //     $ext = explode('/',$sub)[1];

        //     $name = time().".".$ext;
        //     //using image intervention added package to resize the image
        //     $img = Image::make($request->image)->resize(240,200);
        //     $upload_path = 'backend/product/';
        //     $image_url = $upload_path.$name;

        //     $img->save($image_url);

        //     //saving data with image
        //     $product = new Product;
        //     $product->product_name = $request->product_name;
        //     $product->product_code = $request->product_code;
        //     $product->category_id = $request->category_id;
        //     $product->supplier_id = $request->supplier_id;
        //     $product->buying_price = $request->buying_price;
        //     $product->buying_date = $request->buying_date;
        //     $product->product_quantity = $request->product_quantity;
        //     $product->image = $image_url;
        //     $product->save();

        // }
        // else{
        //    //saving data without image

        //    $product = new Product;
        //    $product->product_name = $request->product_name;
        //    $product->product_code = $request->product_code;
        //    $product->category_id = $request->category_id;
        //    $product->supplier_id = $request->supplier_id;
        //    $product->buying_price = $request->buying_price;
        //    $product->buying_date = $request->buying_date;
        //    $product->product_quantity = $request->product_quantity;
        // //    $product->image = $image_url;
        //    $product->save();
        // }
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
   
           ]);

                $data = array();
                // $name = $request->name;
                $image = $request->image;
             
                $data['product_name'] = $request->product_name;
                $data['product_code'] = $request->product_code;
                $data['category_id'] = $request->category_id;
                $data['supplier_id'] = $request->supplier_id;
                $data['root'] = $request->root;
                $data['buying_price'] = $request->buying_price;
                $data['selling_price'] = $request->selling_price;
        
                $data['product_quantity'] = $request->product_quantity;
                $data['buying_date'] = $request->buying_date;

             $image=  $request->file('image')->store('1eMst8IWb6L_psOxLGKHSNl8_MgdkT-TP','google');
             $data['image'] = Storage::disk('google')->url($image);
          
               Product::create($data);                
    // if ($request->image) {
    //         $position = strpos($request->image, ';');
    //         $sub = substr($request->image, 0, $position);
    //         $ext = explode('/', $sub)[1];
   
    //         $name = time().".".$ext;
    //         $img = Image::make($request->image)->resize(240,200);
    //         $upload_path = 'backend/product/';
    //         $image_url = $upload_path.$name;
    //         $img->save($image_url);
   
    //         $product = new Product;
    //         $product->category_id = $request->category_id;
    //         $product->product_name = $request->product_name;
    //         $product->product_code = $request->product_code;
    //         $product->root = $request->root;
    //         $product->buying_price = $request->buying_price;
    //         $product->selling_price = $request->selling_price;
    //         $product->supplier_id = $request->supplier_id;
    //         $product->buying_date = $request->buying_date;
    //         $product->product_quantity = $request->product_quantity;
    //         $product->image = $image_url;
    //         $product->save(); 
    //     }else{
    //        $product = new Product;
    //         $product->category_id = $request->category_id;
    //         $product->product_name = $request->product_name;
    //         $product->product_code = $request->product_code;
    //         $product->root = $request->root;
    //         $product->buying_price = $request->buying_price;
    //         $product->selling_price = $request->selling_price;
    //         $product->supplier_id = $request->supplier_id;
    //         $product->buying_date = $request->buying_date;
    //         $product->product_quantity = $request->product_quantity;
            
    //         $product->save(); 
   
    //     } 
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
        $product = DB::table('products')->where('id',$id)->first();
        return response()->json($product);
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
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_price'] = $request->buying_price;

        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;

        $data['root'] = $request->root;
       
       $image = $request->newimage;

       if($image){
        $position = strpos($image, ';');
        $sub = substr($image, 0,$position);
        $ext = explode('/',$sub)[1];

        $name = time().".".$ext;
        //using image intervention added package to resize the image
        $img = Image::make($image)->resize(240,200);
        $upload_path = 'backend/product/';
        $image_url = $upload_path.$name;
       $success = $img->save($image_url);

       //update with new image
       if($success){
           //accessing the old photo form data
           $data['image'] = $image_url;
           //searching the employees table for the employee with the given request id
           $img = DB::table('products')->where('id',$id)->first();
           //selecting the photo filed of the employee database for the returned employee belonging to the request id above 
           $img_path = $img->image;
           //unlinking the old image in the server image folder
           $done = unlink($img_path);
           //updating the employees table with the new data & the new photo
          DB::table('products')->where('id',$id)->update($data);
       }
       //else if no new image found in the returned form data update with the employees table wth the old image
       }else {
           //use the photo data of the form for the old image data
           $oldphoto = $request->image;
           $data['image'] = $oldphoto;
            DB::table('products')->where('id',$id)->update($data);
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
        $product = DB::table('products')->where('id',$id)->first();
        $image = $product->image;
        if($image){
            unlink($image);
            DB::table('products')->where('id',$id)->delete();

        }else{
            DB::table('products')->where('id',$id)->delete();

        }
    }


    public function stockUpdate(Request $request,$id){
        $data = array();
        $data['product_quantity'] =$request->product_quantity;
        DB::table('products')->where('id', $id)->update($data);
    }
}
