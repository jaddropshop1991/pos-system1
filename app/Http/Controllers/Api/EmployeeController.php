<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Image;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $employee = Employee::all();
        return response()->json($employee);
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
            'name' => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required|unique:employees',
        ]);


        $data = array();
        // $name = $request->name;
        $image = $request->image;
     
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['salary'] = $request->salary;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;

        
     $image=  $request->file('image')->store('1WhBGSErKxSbSjSWGQ8qmfW8jQN_MzdXo','google');
     $data['photo'] = Storage::disk('google')->url($image);
  
       Employee::create($data);


        // if($request->photo){
        //     $position = strpos($request->photo, ';');
        //     $sub = substr($request->photo, 0,$position);
        //     $ext = explode('/',$sub)[1];

        //     $name = time().".".$ext;
        //     //using image intervention added package to resize the image
        //     $img = Image::make($request->photo)->resize(240,200);
        //     $upload_path = 'backend/employee/';
        //     $image_url = $upload_path.$name;

        //     $img->save($image_url);

        //     //saving data with image
        //     $employee = new Employee;
        //     $employee->name = $request->name;
        //     $employee->email = $request->email;
        //     $employee->phone = $request->phone;
        //     $employee->salary = $request->salary;
        //     $employee->address = $request->address;
        //     $employee->nid = $request->nid;
        //     $employee->joining_date = $request->joining_date;
        //     $employee->photo = $image_url;
        //     $employee->save();

        // }
        // else{
        //    //saving data without image

        //     $employee = new Employee;
        //     $employee->name = $request->name;
        //     $employee->email = $request->email;
        //     $employee->phone = $request->phone;
        //     $employee->salary = $request->salary;
        //     $employee->address = $request->address;
        //     $employee->nid = $request->nid;
        //     $employee->joining_date = $request->joining_date;
          
        //     $employee->save();
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
        $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
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

        $data = array();
        // $name = $request->name;
        // $image = $request->image;
        // $name = $request->name;
        // dd($image);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['salary'] = $request->salary;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;

        
    //  $image=  $request->file('image')->store('1WhBGSErKxSbSjSWGQ8qmfW8jQN_MzdXo','google');
    //  $data['photo'] = Storage::disk('google')->url($image);
  
    //    Employee::create($data);



        DB::table('employees')->where('id',$id)->update($data);
        //
    //     $data = array();
    //     $data['name'] = $request->name;
    //     $data['email'] = $request->email;
    //     $data['phone'] = $request->phone;
    //     $data['salary'] = $request->salary;
    //     $data['address'] = $request->address;
    //     $data['nid'] = $request->nid;
    //     $data['joining_date'] = $request->joining_date;
    //    $image = $request->newphoto;

    //    if($image){
    //     $position = strpos($image, ';');
    //     $sub = substr($image, 0,$position);
    //     $ext = explode('/',$sub)[1];

    //     $name = time().".".$ext;
    //     //using image intervention added package to resize the image
    //     $img = Image::make($image)->resize(240,200);
    //     $upload_path = 'backend/employee/';
    //     $image_url = $upload_path.$name;
    //    $success = $img->save($image_url);

    //    //update with new image
    //    if($success){
    //        //accessing the old photo form data
    //        $data['photo'] = $image_url;
    //        //searching the employees table for the employee with the given request id
    //        $img = DB::table('employees')->where('id',$id)->first();
    //        //selecting the photo filed of the employee database for the returned employee belonging to the request id above 
    //        $img_path = $img->photo;
    //        //unlinking the old image in the server image folder
    //        $done = unlink($img_path);
    //        //updating the employees table with the new data & the new photo
    //       DB::table('employees')->where('id',$id)->update($data);
    //    }
    //    //else if no new image found in the returned form data update with the employees table wth the old image
    //    }else {
    //        //use the photo data of the form for the old image data
    //        $oldphoto = $request->photo;
    //        $data['photo'] = $oldphoto;
    //         DB::table('employees')->where('id',$id)->update($data);
    //    }

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
        $employee = DB::table('employees')->where('id',$id)->first();
        $photo = $employee->photo;
        if($photo){
            unlink($photo);
            DB::table('employees')->where('id',$id)->delete();

        }else{
            DB::table('employees')->where('id',$id)->delete();

        }
    }
}
