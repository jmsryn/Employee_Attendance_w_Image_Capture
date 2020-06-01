<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Leave_app;
use App\Overtime_app;
use App\Undertime_app;
use App\Timesheet;
Use App\Http\Controllers\Auth;

class EmployeePageController extends Controller
{
    public function dashboard(){
        $user_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        if($usertype === 'Employee'){
            $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('users', 'users.id', '=', 'employee_infos.user_id')->select('employees.first_name', 'employees.last_name', 'employees.emp_id')->where('users.id', $user_id)->get();

            $emp_id = DB::table('employee_infos')->select('emp_id')->where('user_id',$user_id)->pluck('emp_id');

            $time_info = Timesheet::select('emp_id','date','time','proof','log_type')->where('emp_id',$emp_id)->get();

            $leave_count_0 = Leave_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $leave_count_1 = Leave_app::where('status','Decline')->where('notif_status','Unread')->count();
            $over_count_0 = Overtime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $over_count_1 = Overtime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $under_count_0 = Undertime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $under_count_1 = Undertime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $total_count = $leave_count_0 + $over_count_0 + $under_count_0 + $leave_count_1 + $over_count_1 + $under_count_1;

            // return $time_info;
    
            return view('employee.dashboard',['emp_name' => $emp_info, 'total_count' => $total_count, 'timesheet_info' => $time_info]);
        } else {
            return 'Error';
        }
    }

    public function leave(){
        $user_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        if($usertype === 'Employee'){
            $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('users', 'users.id', '=', 'employee_infos.user_id')->select('employees.first_name', 'employees.last_name', 'employees.emp_id')->where('users.id', $user_id)->get();

            $leave_count_0 = Leave_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $leave_count_1 = Leave_app::where('status','Decline')->where('notif_status','Unread')->count();
            $over_count_0 = Overtime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $over_count_1 = Overtime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $under_count_0 = Undertime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $under_count_1 = Undertime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $total_count = $leave_count_0 + $over_count_0 + $under_count_0 + $leave_count_1 + $over_count_1 + $under_count_1;
    
            return view('employee.leave',['emp_name' => $emp_info, 'total_count' => $total_count]);
        } else {
            return 'Error';
        }
    }

    public function under(){
        $user_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        if($usertype === 'Employee'){
            $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('users', 'users.id', '=', 'employee_infos.user_id')->select('employees.first_name', 'employees.last_name', 'employees.emp_id')->where('users.id', $user_id)->get();

            $leave_count_0 = Leave_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $leave_count_1 = Leave_app::where('status','Decline')->where('notif_status','Unread')->count();
            $over_count_0 = Overtime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $over_count_1 = Overtime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $under_count_0 = Undertime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $under_count_1 = Undertime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $total_count = $leave_count_0 + $over_count_0 + $under_count_0 + $leave_count_1 + $over_count_1 + $under_count_1;
    
            return view('employee.under',['emp_name' => $emp_info, 'total_count' => $total_count]);
        } else {
            return 'Error';
        }
    }

    public function over(){
        $user_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        if($usertype === 'Employee'){
            $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('users', 'users.id', '=', 'employee_infos.user_id')->select('employees.first_name', 'employees.last_name', 'employees.emp_id')->where('users.id', $user_id)->get();

            $leave_count_0 = Leave_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $leave_count_1 = Leave_app::where('status','Decline')->where('notif_status','Unread')->count();
            $over_count_0 = Overtime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $over_count_1 = Overtime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $under_count_0 = Undertime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $under_count_1 = Undertime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $total_count = $leave_count_0 + $over_count_0 + $under_count_0 + $leave_count_1 + $over_count_1 + $under_count_1;
    
            return view('employee.over',['emp_name' => $emp_info, 'total_count' => $total_count]);
        } else {
            return 'Error';
        }
    }

    public function leave_store(Request $request){
        $leave = new Leave_app();

        $leave->emp_id = $request->input('submitBtn');
        $leave->date_from = $request->input('from');
        $leave->date_to = $request->input('to');
        $leave->leave_type = $request->input('leave_type');
        $leave->type = 'Leave';
        $leave->reason = $request->input('reason');
        $leave->status = 'Pending';
        $leave->notif_status = 'Unread';
        $leave->save();

        session()->flash('notif', 'Application sent to admin!');

        return \redirect()->action('EmployeePageController@leave');
    }

    public function over_store(Request $request){
        $over = new Overtime_app();

        $over->emp_id = $request->input('submitBtn');
        $over->date = $request->input('date_req');
        $over->hours = $request->input('hours');
        $over->type = 'Overtime';
        $over->reason = $request->input('reason');
        $over->status = 'Pending';
        $over->notif_status = 'Unread';

        $over->save();

        session()->flash('notif', 'Application sent to admin!');
        return \redirect()->action('EmployeePageController@over');
    }

    public function under_store(Request $request){
        $under = new Undertime_app();

        $under->emp_id = $request->input('submitBtn');
        $under->date = $request->input('date_req');
        $under->hours = $request->input('hours');
        $under->type = 'Undertime';
        $under->reason = $request->input('reason');
        $under->status = 'Pending';
        $under->notif_status = 'Unread';

        $under->save();

        session()->flash('notif', 'Application sent to admin!');
        return \redirect()->action('EmployeePageController@under');
    }

    public function notification(){
        $user_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        if($usertype === 'Employee'){
            $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('users', 'users.id', '=', 'employee_infos.user_id')->select('employees.first_name', 'employees.last_name', 'employees.emp_id')->where('users.id', $user_id)->get();

            $leave_count_0 = Leave_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $leave_count_1 = Leave_app::where('status','Decline')->where('notif_status','Unread')->count();
            $over_count_0 = Overtime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $over_count_1 = Overtime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $under_count_0 = Undertime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $under_count_1 = Undertime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $total_count = $leave_count_0 + $over_count_0 + $under_count_0 + $leave_count_1 + $over_count_1 + $under_count_1;

            $notification = array();

            $leave_app = Leave_app::select('id','emp_id', 'type','status')->whereIn('status',['Accepted','Decline'])->where('notif_status','=','Unread')->get();
            $under_app = Undertime_app::select('id','emp_id', 'type','status')->whereIn('status',['Accepted','Decline'])->where('notif_status','=','Unread')->get();
            $over_app = Overtime_app::select('id','emp_id', 'type','status')->whereIn('status',['Accepted','Decline'])->where('notif_status','=','Unread')->get();

            foreach ($leave_app as $leave){
                array_push($notification,$leave);
            }
    
            foreach ($over_app as $leave){
                array_push($notification,$leave);
            }
    
            foreach ($under_app as $leave){
                array_push($notification,$leave);
            }


            // return $leave_app;
    
            return view('employee.notification',['emp_name' => $emp_info, 'total_count' => $total_count, 'app_details' => $notification]);
        } else {
            return 'Error';
        }
    }

    public function notif_update($type,$id){
        if($type == 'Leave'){
            $leave = new Leave_app();

            $leave_up = $leave::find($id);
            $leave_up->notif_status = "Read";

            $leave_up->save();

            session()->flash('notif', 'Application move to archive!');
            return \redirect()->action('EmployeePageController@notification');
        } else if ($type == 'Undertime'){
            $under = new Undertime_app();

            $under_up = $under::find($id);
            $under_up->notif_status = "Read";

            $under_up->save();

            session()->flash('notif', 'Application move to archive!');
            return \redirect()->action('EmployeePageController@notification');
        } else if ($type == 'Overtime'){
            $over = new Overtime_app();

            $over_up = $over::find($id);
            $over_up->notif_status = "Read";

            $over_up->save();
            
            session()->flash('notif', 'Application move to archive!');
            return \redirect()->action('EmployeePageController@notification');
        }
    }

    public function archive(){
        $user_id = auth()->user()->id;

        $usertype = auth()->user()->user_type;

        if($usertype === 'Employee'){
            $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('users', 'users.id', '=', 'employee_infos.user_id')->select('employees.first_name', 'employees.last_name', 'employees.emp_id')->where('users.id', $user_id)->get();

            $leave_count_0 = Leave_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $leave_count_1 = Leave_app::where('status','Decline')->where('notif_status','Unread')->count();
            $over_count_0 = Overtime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $over_count_1 = Overtime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $under_count_0 = Undertime_app::where('status','Accepted')->where('notif_status','Unread')->count();
            $under_count_1 = Undertime_app::where('status','Decline')->where('notif_status','Unread')->count();
            $total_count = $leave_count_0 + $over_count_0 + $under_count_0 + $leave_count_1 + $over_count_1 + $under_count_1;

            $notification = array();

            $leave_app = Leave_app::select('id','emp_id', 'type','status')->where('notif_status','Read')->get();
            $under_app = Undertime_app::select('id','emp_id', 'type','status')->where('notif_status','Read')->get();
            $over_app = Overtime_app::select('id','emp_id', 'type','status')->where('notif_status','Read')->get();

            foreach ($leave_app as $leave){
                array_push($notification,$leave);
            }
    
            foreach ($over_app as $leave){
                array_push($notification,$leave);
            }
    
            foreach ($under_app as $leave){
                array_push($notification,$leave);
            }


            // return $notification;
    
            return view('employee.archive',['emp_name' => $emp_info, 'total_count' => $total_count, 'app_details' => $notification]);
        } else {
            return 'Error';
        }
        
    }

    public function archive_view($type, $id){
        $user_id = auth()->user()->id;

        $emp_info = DB::table('employee_infos')->join('employees', 'employees.emp_id', '=', 'employee_infos.emp_id')->join('users', 'users.id', '=', 'employee_infos.user_id')->select('employees.first_name', 'employees.last_name', 'employees.emp_id')->where('users.id', $user_id)->get();

        $leave_count_0 = Leave_app::where('status','Accepted')->where('notif_status','Unread')->count();
        $leave_count_1 = Leave_app::where('status','Decline')->where('notif_status','Unread')->count();
        $over_count_0 = Overtime_app::where('status','Accepted')->where('notif_status','Unread')->count();
        $over_count_1 = Overtime_app::where('status','Decline')->where('notif_status','Unread')->count();
        $under_count_0 = Undertime_app::where('status','Accepted')->where('notif_status','Unread')->count();
        $under_count_1 = Undertime_app::where('status','Decline')->where('notif_status','Unread')->count();
        $total_count = $leave_count_0 + $over_count_0 + $under_count_0 + $leave_count_1 + $over_count_1 + $under_count_1;


        if ($type == 'Overtime') {
            $over_details = DB::table('overtime_apps')->select('date','hours','reason')->where('id',$id)->get();
            
            return view('employee.archive_over',['emp_name' => $emp_info, 'over_details' => $over_details, 'total_count' => $total_count]);
            
        } else if ($type == 'Undertime') {
            $under_details = DB::table('undertime_apps')->select('date','hours','reason')->where('id',$id)->get();

            return view('employee.archive_under',['emp_name' => $emp_info, 'under_details' => $under_details, 'total_count' => $total_count]);

        } else if ($type == 'Leave') {
            $leave_details = DB::table('leave_apps')->select('leave_type','date_from','date_to','reason')->where('id',$id)->get();
            
            return view('employee.archive_leave',['emp_name' => $emp_info, 'leave_details' => $leave_details, 'total_count' => $total_count]);
        }
    }

    public function login(){

        
        return view('login');
    }
}
