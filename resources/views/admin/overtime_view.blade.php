@extends('inc.admin_dashboard')
@section('main-content')
<h2>Application for overtime</h2>
<hr>
<div class="emp-cell">
    <div class="app-emp">
        @foreach ($avatar as $item)
            <img src="\storage\images\{{ $item->avatar }}" alt="" width="150px" height="150px">
        @endforeach
        @foreach ($emp_infos as $item)
            <p>{{ $item->first_name }} {{ $item->last_name }} <span>({{ $item->emp_id }})</span></p>
            <p>Employee</p>
        @endforeach
        
    </div>
    <div class="app-form">
        <h2>Overtime Details:</h2>
        <form action="/admin/overtime_view" method="POST">
            @csrf
            <table>
                <tbody>
                    @foreach ($app_info as $item)
                    <tr>
                        <td>Date requested: </td>
                        <td><input type="date" name="date_req" id="date_req" value="{{ $item->date }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Hours: </td>
                        <td><input type="number" name="hours" id="hours" value="{{ $item->hours }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Reason:</td>
                        <td><textarea name="reason" id="reason" cols="40" rows="4" readonly>{{ $item->reason }}</textarea></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td><input style="font-family: FontAwesome;" type="button" name="over" id="editApp" value="&#xf044; Edit">
                            <input type="text" name="emp_id" value="{{ $emp_id }}" class="hide">
                            <button class="hide" id="saveApp" type="submit" value="{{ $item->id }}" name="saveApp"><span><i class="fas fa-save"></i></span> Save</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
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