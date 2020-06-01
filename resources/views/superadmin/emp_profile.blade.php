@extends('inc.superadmin_dashboard')
@section('main-content')
<div class="emp-profile" id="empProfile">
    <div class="emp-profile-container">
        <div class="emp-profile-pic">
            <div class="app-emp">
                @foreach ($avatar as $item)
                    <img src="\storage\images\{{ $item->avatar }}" alt="" width="150px" height="150px">
                @endforeach
                @foreach ($data as $item)
                    <p>{{ $item->first_name }} {{ $item->last_name }} <span>({{ $item->emp_id }})</span></p>
                    <p>Employee</p>
                @endforeach
            </div>
        </div>
        <div class="emp-profile-details">
            <h3>Employee Details:</h3><br>
            @foreach ($data as $item)
            <form action="/superadminprofile" method="POST">
                @csrf
                <table>
                        <tr>
                            <td><label for="">Fullname: </label></td>
                            <td><input type="text" name="" id="" value="{{ $item->first_name }} {{ $item->last_name }}" readonly></td>
                            <td><label for="">Department:<span style="color: red;">*</span> </label></td>
                            <td><select name="" id="dept_d" disabled>
                                <option value="">{{ $item->dept_name }}</option>
                            </select>
                                <select name="depts" id="dept_a" class="hide">
                                @foreach ($dept as $info)
                                    <option value="{{ $info->dept_id }}">{{ $info->dept_name }}</option>
                                @endforeach
                                </select>
                        </td>
                        </tr>
                        <tr>
                            <td><label for="">Sex:</label></td>
                            <td><input type="text" value="{{ $item->sex }}" readonly></td>
                            <td><label for="">Date of birth: </label></td>
                            <td><input type="text" name="" id="" value="{{ $item->date_of_birth }}" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="">Contact Number:<span style="color: red;">*</span> </label></td>
                            <td><input type="text" name="contact" id="contact" value="{{ $item->contact_number }}" readonly></td>
                            <td><label for="">Email Address:<span style="color: red;">*</span>  </label></td>
                            <td><input type="email" name="email" id="email" value="{{ $item->email }}" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="">Address:<span style="color: red;">*</span> </label></td>
                            <td><input type="text" name="address" id="addr" value="{{ $item->address }}" readonly size="27"></td>
                            <td><label for="">User type:<span style="color: red;">*</span> </label></td>
                            <td><select name="" id="user_type_d" disabled>
                                <option value="">{{ $item->user_type }}</option>
                            </select>
                                <select name="user_type" id="user_type_a" class="hide">
                                <option value="Employee">Employee</option>
                                <option value="Admin">Admin</option>
                                <option value="Superadmin">Superadmin</option>
                            </select>
                        </td>
                        </tr>
                    </table>
                    <div class="profile_btn" style="display: flex; justify-content: center;">
                        <input style="font-family: FontAwesome; padding: .6rem 1rem;" type="button" name="profile" id="editApp" value="&#xf044; Edit">
                        <input type="text" name="emp_id" value="{{ $item->emp_id }}" class="hide">
                        <input type="text" name="emp_info_id" value="{{ $item->emp_info_id }}" class="hide">
                        <button style="font-family: FontAwesome; padding: .6rem 1rem;" class="hide" id="saveApp" type="submit" value="{{ $item->id }}" name="saveApp"><span><i class="fas fa-save"></i></span> Save</button>       
                    </div>   
                </form>
            @endforeach
        </div>
    </div>
</div>
@if (session()->has('notif'))
<div class="notif" id="notif">
    <div class="profile-nav-top" >
        <div class="notif-msg">
            <p><span>Notification:</span>{{ session()->get('notif') }}</p>
        </div>
        <div class="close">
            <span id="closeNotif"><i class="fas fa-times"></i></span>
        </div>
    </div>
</div>
@endif
@endsection