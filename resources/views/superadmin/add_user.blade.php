@extends('inc.superadmin_dashboard')
@section('main-content')

<div class="add-user-header">
    <span><i class="fas fa-user-plus"></i></span>
    <p>Register Employee</p>
</div>
<form action="/superadminadd" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="add-user">
        <div class="personal-details">
            <h2>Personal Details:</h2>
            <table>
                <tbody>
                    <tr>
                        <td><label for="">First Name:<span style="color: red;">*</span> </label></td>
                        <td><input type="text" name="fname" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="">Last Name:<span style="color: red;">*</span> </label></td>
                        <td><input type="text" name="lname" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="">Sex:<span style="color: red;">*</span></label></td>
                        <td><select name="sex" id="">
                            <option value="Male">Male</option>    
                            <option value="Female">Female</option>    
                        </select></td>
                    </tr>
                    <tr>
                        <td><label for="">Contact Number:<span style="color: red;">*</span> </label></td>
                        <td><input type="text" name="contactno" id=""</td>
                    </tr>
                    <tr>
                        <td><label for="">Address:<span style="color: red;">*</span> </label></td>
                        <td><input type="text" name="addr" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="">Date of birth:<span style="color: red;">*</span> </label></td>
                        <td><input type="date" name="dob" id=""></td>
                    </tr>
                    <tr>
                        <td>Photo:<span style="color: red;">*</span> </td>
                        <td><input type="file" name="photo" id=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="company-details">
            <h2>Company Related Details: </h2>
            <table>
                <tbody>
                    <tr>
                        <td><label for="">Department:<span style="color: red;">*</span> </label></td>
                        <td><select name="dept" id="">
                            @foreach ($data as $item)
                                <option value="{{ $item->dept_id }}">{{ $item->dept_name }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <td><label for="">Email Address:<span style="color: red;">*</span>  </label></td>
                        <td><input type="email" name="email" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="">Password:<span style="color: red;">*</span> </label></td>
                        <td><input type="password" name="password" id=""></td>
                    </tr>
                    <tr>
                        <td><label for="">User type:<span style="color: red;">*</span> </label></td>
                        <td><select name="utype" id="">
                            <option value="Employee">Employee</option>
                            <option value="Admin">Admin</option>
                            <option value="Superadmin">Superadmin</option>
                        </select></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Register">
        </div>
    </div>
</form>
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