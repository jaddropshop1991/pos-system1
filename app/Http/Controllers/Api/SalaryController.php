<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SalaryController extends Controller
{
    //
    public function Paid(Request $request, $id){
        $validateData = $request->validate([
            'salary_month'=>'required',

        ]);
        //check if the salary_month send by form request is found in previous DB employee salary record so the salary is not paid again for the same month and same employee
$month = $request->salary_month;
$check = DB::table('salaries')->where('employee_id',$id)->where('salary_month', $month)
        ->first();
        if($check){
            return response()->json('Salary Already Paid');
        }else{
            $data = array();
            $data['employee_id']=$id;
            $data['amount']=$request->salary;
            $data['salary_date']=date('d/m/y');
            $data['salary_month']=$month;
            $data['salary_year']=date('Y');
          DB::table('salaries')->insert($data);
        }





        
    }

    public function allSalaries(){
       $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')
       ->get();
       return response()->json($salary);
    }

    public function viewSalary($id){

//to get the name in the employees table that matches that refers to the employee_id in the salaries table
//based on the month name found in salaries that is passed as a parameter in this function by the view.vue 
        $month = $id;
        $view = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name', 'salaries.*')
        ->where('salaries.salary_month',$month)
        ->get();
        return response()->json($view);
    }


    public function editSalary($id){
       
        $view = DB::table('salaries')
        ->join('employees','salaries.employee_id','employees.id')
        ->select('employees.name','employees.email', 'salaries.*')
        ->where('salaries.id',$id)
        ->first();
        return response()->json($view);
    }



    public function salaryUpdate(Request $request,$id){
        $data = array();
        $data['employee_id']= $request->employee_id;
        $data['amount']= $request->amount;
        $data['salary_month']= $request->salary_month;
      DB::table('salaries')->where('id',$id)->update($data);

    }
}
