@extends('inc.emp_dashboard')
@section('main-content')
<h2>Application for overtime</h2>
<hr>
<div class="emp-cell">
    <div class="app-emp">
        @foreach ($emp_name as $item)
            <img src="\storage\images\{{ Auth::user()->avatar }}" alt="" width="100px" height="100px">
            <p>{{ $item->first_name }} {{ $item->last_name }} <span>({{ $item->emp_id }})</span></p>
            <p>Employee</p>
        @endforeach
        
    </div>
    <div class="app-form">
        <h2>Overtime Form</h2>
        <form action="/over" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td>Date requested: </td>
                        <td><input type="date" name="date_req" id=""></td>
                    </tr>
                    <tr>
                        <td>Hours: </td>
                        <td><input type="number" name="hours" id=""></td>
                    </tr>
                    <tr>
                        <td>Reason:</td>
                        <td><textarea name="reason" id="" cols="40" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td> </td>
                        @foreach ($emp_name as $item)
                        <td><button type="submit" value="{{ $item->emp_id }}" name="submitBtn">Submit</button></td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
@if (session()->has('notif'))
<div class="notif" id="notif">
    <div class="profile-nav-top" >
        <div class="notif-msg">
            <p><span>Notification: </span>{{ session()->get('notif') }}</p>
        </div>
        <div class="close">
            <span id="closeNotif"><i class="fas fa-times"></i></span>
        </div>
    </div>
</div>
@endif
<script>
    const dropdown = document.getElementById('dropdowntoggle')
    const drop = document.getElementById('dropClass')

    dropdown.addEventListener('click', function(){
            if(drop.classList.contains('hide')){
                drop.classList.remove('hide')
            } else {
                drop.classList.add('hide')
            }
        })
</script>
@endsection