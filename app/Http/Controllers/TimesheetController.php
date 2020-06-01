<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Time_in;
use App\Time_out;
use App\Timesheet;

class TimesheetController extends Controller
{

    public function index(){
        return view('input');
    }

    public function idnum_check(Request $request){
        $emp_id = $request->input('idnum');
        $emp = Employee::where('emp_id','=',$emp_id)->count();

        if ($emp > 0) {
            return \redirect()->action('TimesheetController@capture_select',['id'=>$emp_id]);
        } else {
            session()->flash('notif', 'Invalid ID');

            return \redirect()->action('TimesheetController@index');
        }

    }

    public function capture_select($id){
        return view('capture',['emp_id' => $id]);
    }

    public function timein($id,Request $request){

        $emp_info = Employee::select('emp_id','first_name')->where('emp_id',$id)->get();
        $log_type = $request->input('selectBtn');

        return view('time_in',['emp_info' => $emp_info, 'log_type' => $log_type]);
    }

    public function timein_store(Request $request){
        $emp_id = $request->input('idnum');
        date_default_timezone_set('Asia/Manila');
        $time = date("Y-m-d-h-i");
        $day = date("l");
        $img = $_POST['image'];
        $folderPath = "./upload/";
    
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
    
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $emp_id.  '-' . $time . '.png';
    
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $timesheet = new Timesheet();

        $timesheet->emp_id = $emp_id;
        $timesheet->date = date("Y-m-d");
        $timesheet->time = date("h:i A");
        $timesheet->proof = $fileName;
        $timesheet->log_type = $request->input('log_type');

        $timesheet->save();

        // return $request->input('selectBtn');

        return \redirect()->action('TimesheetController@index');
    }
}
