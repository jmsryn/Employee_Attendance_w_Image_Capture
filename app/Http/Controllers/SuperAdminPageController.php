<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Employee_info;
use App\Department;
use App\Leave_app;
use App\Overtime_app;
use App\Undertime_app;
use App\User;
use App\Timesheet;
use Illuminate\Support\Facades\Hash;
use DB;
Use App\Http\Controllers\Auth;
Use App\Http\Controllers\Storage;


class SuperAdminPageController extends Controller
{
    public function superadmindashboard(){
        $hr_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        ###Get Superadmin details
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
        
        return view('superadmin.emp_list',['hr_names' => $hr_info, 'emp_infos' => $details]);
    }

    public function superadminprofile($emp_id ,Request $request){
        $emp = new Employee();
        $user = new User();
        $emp_info = new Employee_info();
        $hr_id = auth()->user()->id;

        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('departments', 'departments.dept_id', '=', 'employee_infos.dept_id')->join('users','users.id','=','employee_infos.user_id')->select('employee_infos.emp_info_id','employees.emp_id','employees.first_name', 'employees.last_name','employees.sex','employees.contact_number','employees.address','employees.date_of_birth', 'departments.dept_name','users.email', 'users.user_type', 'users.id')->where('employees.emp_id', $emp_id)->get();

        $dept = Department::select('dept_id','dept_name')->get();


        return view('superadmin.emp_profile',['hr_names' => $hr_info,'data' => $emp_info, 'avatar' => $avatar, 'dept' => $dept]);
    }

    public function emp_profile_update(Request $request){
        $user_id = $request->input('saveApp');
        $emp_id = $request->input('emp_id');
        $emp_info_id = $request->input('emp_info_id');

        $users = new User();
        $employee = new Employee();
        $employee_infos = new Employee_info();

        $employee_up = $employee::find($emp_id);
        $employee_up->contact_number = $request->input('contact');
        $employee_up->address = $request->input('address');

        $users_up = $users::find($user_id);
        $users_up->email = $request->input('email');
        $users_up->user_type = $request->input('user_type');

        $emp_info_up = $employee_infos::find($emp_info_id);
        $emp_info_up->dept_id = $request->input('depts');

        $employee_up->save();
        $users_up->save();
        $emp_info_up->save();

        session()->flash('notif', 'Employee Updated!');

        return \redirect()->action('SuperAdminPageController@superadminprofile',['emp_id' => $emp_id]);
    }

    public function superadmintime($id){
        $hr_id = auth()->user()->id;

        ###Get Superadmin details
        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $emp_info = DB::table('employees')->select('last_name')->where('emp_id',$id)->get();

        $timesheet_details = DB::table('timesheets')->select('time_sheet_id', 'emp_id', 'date', 'time','log_type', 'proof')->where('emp_id', $id)->get(); 

        return view('superadmin.emp_time',['hr_names' => $hr_info, 'timesheet_info' => $timesheet_details, 'emp_info' => $emp_info]);
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

        return \redirect()->action('SuperAdminPageController@superadmintime',['id' => $emp_id]);
    }

    public function superadminapp($id){
        $hr_id = auth()->user()->id;

        ###Get Superadmin details
        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        ###Get App list
        $app_full_list = array();

        $leave_list = DB::table('leave_apps')->select('id','type','status')->where('emp_id',$id)->get();
        $over_list = DB::table('overtime_apps')->select('id','type','status')->where('emp_id',$id)->get();
        $under_list = DB::table('undertime_apps')->select('id','type','status')->where('emp_id',$id)->get();

        $emp_info = DB::table('employees')->select('last_name')->where('emp_id',$id)->get();

        foreach ($leave_list as $leave){
            array_push($app_full_list,$leave);
        }

        foreach ($over_list as $leave){
            array_push($app_full_list,$leave);
        }

        foreach ($under_list as $leave){
            array_push($app_full_list,$leave);
        }


        // return $id;
        return view('superadmin.emp_app',['hr_names' => $hr_info, 'app_list' => $app_full_list, 'emp_id' => $id, 'emp_info' => $emp_info]);
    }

    public function superadminadd(){
        $dept = new Department();

        $hr_id = auth()->user()->id;

        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $dept_names = $dept::all();

        // return view('superadmin.add_user',['data' => $dept_names]);
        return view('superadmin.add_user',['data' => $dept_names, 'hr_names' => $hr_info]);
    }

    public function store(Request $request){
        $emp = new Employee();
        $user = new User();
        $emp_info = new Employee_info();

        // $emp_id = 2020000000;
        // $user_id = 1;
        $emp_id = $emp::all()->last()->emp_id;
        $user_id = $user::all()->last()->id;
        $emp_id += 1;
        $user_id += 1;
        $md5Name = md5_file($request->file('photo')->getRealPath());
        $guessExtension = $request->file('photo')->guessExtension();
        $file_name = $md5Name.'.'.$guessExtension;
        $request->file('photo')->storeAs('images', $md5Name.'.'.$guessExtension  ,'public');

        $emp->emp_id = $emp_id;
        $emp->first_name = $request->input('fname');
        $emp->last_name = $request->input('lname');
        $emp->sex = $request->input('sex');
        $emp->contact_number = $request->input('contactno');
        $emp->address = $request->input('addr');
        $emp->date_of_birth = $request->input('dob');

        // $user->emp_id = $emp_id;
        $user->id = $user_id;
        $user->user_type = $request->input('utype');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->avatar = $file_name;


        $emp_info->user_id = $user_id;
        $emp_info->emp_id = $emp_id;
        $emp_info->dept_id = $request->input('dept');

        $emp->save();
        $user->save();
        $emp_info->save();

        session()->flash('notif', 'Employee Added!');

        return \redirect()->action('SuperAdminPageController@superadminadd');


        // return $md5Name.'.'.$guessExtension;

    }

    public function superadminviewapp(){
        $hr_id = auth()->user()->id;

        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        return view('superadmin.view_app', ['hr_names' => $hr_info]);
    }

    public function leave_view($emp_id, $leave_id, Request $request){
        $hr_id = auth()->user()->id;


        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        $app_data = DB::table('leave_apps')->select('id','leave_type','date_from', 'date_to','reason')->where('id',$leave_id)->get();

        return view('superadmin.leave_view', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id, 'avatar' => $avatar]);
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

        return \redirect()->action('SuperAdminPageController@leave_view',['emp_id' => $emp_id, 'leave_id' => $leave_id]);
    }

    public function undertime_view($emp_id, $undertime_id, Request $request){

        $hr_id = auth()->user()->id;

        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        ###get data
        $app_data = DB::table('undertime_apps')->select('id','date','hours','reason')->where('id',$undertime_id)->get();

        return view('superadmin.undertime_view', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data,'emp_id' => $emp_id, 'avatar' => $avatar]);
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

        return \redirect()->action('SuperAdminPageController@undertime_view',['emp_id' => $emp_id, 'undertime_id' => $undertime_update]);
    }

    public function overtime_view($emp_id, $overtime_id, Request $request){
        $hr_id = auth()->user()->id;

        $hr_info = DB::table('employee_infos')->join('employees', 'employees.emp_id','=','employee_infos.emp_id')->join('users','users.id','=','employee_infos.user_id')->select('employees.first_name','employees.last_name')->where('users.id',$hr_id)->get();

        $avatar = DB::table('employee_infos')->join('users','id','=','employee_infos.user_id')->select('users.avatar')->where('employee_infos.emp_id',$emp_id)->get();

        $emp_infos = DB::table('employees')->select('emp_id','first_name','last_name')->where('emp_id', $emp_id)->get();

        ###get data
        $app_data = DB::table('overtime_apps')->select('id','date','hours','reason')->where('id',$overtime_id)->get();

        return view('superadmin.overtime_view', ['hr_names' => $hr_info, 'emp_infos' => $emp_infos, 'app_info' => $app_data, 'emp_id' => $emp_id, 'avatar' => $avatar]);
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

        return \redirect()->action('SuperAdminPageController@overtime_view',['emp_id' => $emp_id, 'overtime_id' => $overtime_id]);
    }
}
