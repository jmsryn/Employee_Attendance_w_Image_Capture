<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Leave_app;
use App\Overtime_app;
use App\Undertime_app;
use App\Timesheet;
Use App\Http\Controllers\Auth;

class AdminPageController extends Controller
{
    public function index(){
        $hr_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        ###Get Admin details
        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        ###Fetch Employee Only Infos
        $user_ids = DB::table('users')->select('id')->where('user_type','Employee')->get();
        $array = array();
        foreach ($user_ids as $value){
            array_push($array,$value->id);
        }
        $details = array();
        foreach ($array as $value){
            $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('departments', 'departments.dept_id', '=', 'employee_infos.dept_id')->join('users', 'users.id','=','employee_infos.user_id')->select('employees.emp_id','employees.first_name', 'employees.last_name', 'departments.dept_name')->where('users.id', $value)->get();

            array_push($details,$emp_info);
        }

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        return view('admin.emp_list',['hr_names' => $hr_info, 'emp_infos' => $details, 'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count]);
    }

    public function admintime($id){
        $hr_id = auth()->user()->id;

        ###Get Superadmin details
        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        $emp_info = DB::table('employees')->select('last_name')->where('emp_id',$id)->get();

        $timesheet_details = DB::table('timesheets')->select('time_sheet_id', 'emp_id', 'date', 'time','log_type', 'proof')->where('emp_id', $id)->get(); 

        return view('admin.emp_time',['hr_names' => $hr_info, 'timesheet_info' => $timesheet_details, 'emp_info' => $emp_info, 'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count]);
    }

    public function update_timesheet(Request $request){
        $time_id = $request->input('time_id');
        $emp_id = $request->input('saveApp');

        $timesheet = new Timesheet();

        $timesheet_update = $timesheet::find($time_id);
        $timesheet_update->date = $request->input('date');
        $timesheet_update->time = $request->input('time');
        $timesheet_update->save();

        session()->flash('notif', 'Timesheet Updated!');

        return \redirect()->action('AdminPageController@admintime',['id' => $emp_id]);
    }

    public function adminapp($id){
        $hr_id = auth()->user()->id;

        ###Get Superadmin details
        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        ###Get App list
        $app_full_list = array();

        $leave_list = DB::table('leave_apps')->select('id','type','status')->where('emp_id',$id)->get();
        $over_list = DB::table('overtime_apps')->select('id','type','status')->where('emp_id',$id)->get();
        $under_list = DB::table('undertime_apps')->select('id','type','status')->where('emp_id',$id)->get();

        $emp_info = DB::table('employees')->select('last_name')->where('emp_id',$id)->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        foreach ($leave_list as $leave){
            array_push($app_full_list,$leave);
        }

        foreach ($over_list as $leave){
            array_push($app_full_list,$leave);
        }

        foreach ($under_list as $leave){
            array_push($app_full_list,$leave);
        }

        return view('admin.emp_app',['hr_names' => $hr_info, 'app_list' => $app_full_list, 'emp_id' => $id, 'emp_info' => $emp_info,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count]);
    }

    public function leave_view($emp_id, $leave_id, Request $request){
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        $app_data = DB::table('leave_apps')->select('id','leave_type','date_from', 'date_to','reason')->where('id',$leave_id)->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        return view('admin.leave_view', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count, 'avatar' => $avatar]);
    }

    public function update_leave(Request $request){
        $leave = new Leave_app();

        $leave_id = $request->input('saveApp');
        $emp_id = $request->input('emp_id');

        $leave_update = $leave::find($leave_id);
        $leave_update->leave_type = $request->input('leave_type');
        $leave_update->date_from = $request->input('from');
        $leave_update->date_to = $request->input('to');
        $leave_update->reason = $request->input('reason');
        $leave_update->save();

        session()->flash('notif', 'Application Updated!');

        return \redirect()->action('AdminPageController@leave_view',['emp_id' => $emp_id, 'leave_id' => $leave_id]);
    }

    public function undertime_view($emp_id, $undertime_id, Request $request){
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        $app_data = DB::table('undertime_apps')->select('id','date','hours','reason')->where('id',$undertime_id)->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;


        return view('admin.undertime_view', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count, 'avatar' => $avatar]);
    }

    public function update_undertime(Request $request){
        $leave = new Undertime_app();

        $undertime_id = $request->input('saveApp');
        $emp_id = $request->input('emp_id');

        $undertime_update = $leave::find($undertime_id);
        $undertime_update->date = $request->input('date_req');
        $undertime_update->hours = $request->input('hours');
        $undertime_update->reason = $request->input('reason');
        $undertime_update->save();

        session()->flash('notif', 'Application Updated!');

        return \redirect()->action('AdminPageController@undertime_view',['emp_id' => $emp_id, 'undertime_id' => $undertime_update]);
    }

    public function overtime_view($emp_id, $overtime_id, Request $request){
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        $app_data = DB::table('overtime_apps')->select('id','date','hours','reason')->where('id',$overtime_id)->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        return view('admin.overtime_view', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count, 'avatar' => $avatar]);
    }

    public function update_overtime(Request $request){
        $leave = new Overtime_app();

        $overtime_id = $request->input('saveApp');
        $emp_id = $request->input('emp_id');

        $overtime_update = $leave::find($overtime_id);
        $overtime_update->date = $request->input('date_req');
        $overtime_update->hours = $request->input('hours');
        $overtime_update->reason = $request->input('reason');
        $overtime_update->save();

        session()->flash('notif', 'Application Updated!');

        return \redirect()->action('AdminPageController@overtime_view',['emp_id' => $emp_id, 'overtime_id' => $overtime_id]);
    }

    public function app_leave(){
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $emp_details = DB::table('leave_apps')->join('employees','employees.emp_id','=','leave_apps.emp_id')->select('leave_apps.id','employees.emp_id','employees.first_name','employees.last_name','leave_apps.status')->where('leave_apps.status','Pending')->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        // return $emp_details;
        return view('admin.app_leave', ['hr_names' => $hr_info, 'leave_list' => $emp_details,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count]);
    }

    public function app_leave_respond($emp_id, $leave_id){
        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;
        
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        $app_data = DB::table('leave_apps')->select('id','leave_type','date_from', 'date_to','reason')->where('id',$leave_id)->get();

        return view('admin.app_leave_respond', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count, 'avatar' => $avatar]);
    }

    public function leave_update(Request $request){
        $decision = $request->input('decision');
        $leave_id = $request->input('id');
        $leave = new Leave_app();

        if($decision == 'Accept'){
            $leave_respond = $leave::find($leave_id);
            $leave_respond->status = 'Accepted';
            $leave_respond->save();

            session()->flash('notif', 'Application Approved!');

        } else if ($decision == 'Decline'){
            $leave_respond = $leave::find($leave_id);
            $leave_respond->status = 'Decline';
            $leave_respond->save();

            session()->flash('notif', 'Application Decline!');
        }

        return \redirect()->action('AdminPageController@app_leave');
    }

    public function app_under(){
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $emp_details = DB::table('undertime_apps')->join('employees','employees.emp_id','=','undertime_apps.emp_id')->select('undertime_apps.id','employees.emp_id','employees.first_name','employees.last_name','undertime_apps.status')->where('undertime_apps.status','Pending')->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        // return $emp_details;
        return view('admin.app_under', ['hr_names' => $hr_info, 'leave_list' => $emp_details,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count]);
    }

    public function app_under_respond($emp_id, $undertime_id){
        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;
        
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        $app_data = DB::table('undertime_apps')->select('id','date','hours','reason')->where('id',$undertime_id)->get();

        return view('admin.app_under_respond', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count, 'avatar' => $avatar]);
    }

    public function under_update(Request $request){
        $decision = $request->input('decision');
        $leave_id = $request->input('id');
        $under = new Undertime_app();

        if($decision == 'Accept'){
            $under_respond = $under::find($leave_id);
            $under_respond->status = 'Accepted';
            $under_respond->save();

            session()->flash('notif', 'Application Approved!');

        } else if ($decision == 'Decline'){
            $under_respond = $under::find($leave_id);
            $under_respond->status = 'Decline';
            $under_respond->save();

            session()->flash('notif', 'Application Decline!');
        }

        return \redirect()->action('AdminPageController@app_under');
    }
    
    public function app_over(){
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $emp_details = DB::table('overtime_apps')->join('employees','employees.emp_id','=','overtime_apps.emp_id')->select('overtime_apps.id','employees.emp_id','employees.first_name','employees.last_name','overtime_apps.status')->where('overtime_apps.status','Pending')->get();

        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;

        // return $emp_details;
        return view('admin.app_over', ['hr_names' => $hr_info, 'leave_list' => $emp_details,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count]);
    }

    public function app_over_respond($emp_id, $overtime_id){
        $leave_count = Leave_app::where('status','Pending')->count();
        $over_count = Overtime_app::where('status','Pending')->count();
        $under_count = Undertime_app::where('status','Pending')->count();
        $total_count = $leave_count + $over_count + $under_count;
        
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        $app_data = DB::table('overtime_apps')->select('id','date','hours','reason')->where('id',$overtime_id)->get();

        return view('admin.app_over_respond', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id,'leave_count' => $leave_count, 'over_count' => $over_count, 'under_count' => $under_count, 'total_count' => $total_count, 'avatar' => $avatar]);
    }

    public function over_update(Request $request){
        $decision = $request->input('decision');
        $over_id = $request->input('id');
        $over = new Overtime_app();

        if($decision == 'Accept'){
            $over_respond = $over::find($over_id);
            $over_respond->status = 'Accepted';
            $over_respond->save();

            session()->flash('notif', 'Application Approved!');

        } else if ($decision == 'Decline'){
            $over_respond = $over::find($over_id);
            $over_respond->status = 'Decline';
            $over_respond->save();

            session()->flash('notif', 'Application Decline!');
        }

        return \redirect()->action('AdminPageController@app_over');
    }
}
