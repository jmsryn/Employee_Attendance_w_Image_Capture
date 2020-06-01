@extends('inc.admin_dashboard')
@section('main-content')
<h2>Application for leave</h2>
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
        <h2>Leave Form</h2>
        <form action="/admin/application_leave" method="POST">
            @csrf
            <table>
                <tbody>
                        @foreach ($app_info as $item)
                        <tr>
                            <td>Reason for request leave: </td>
                            <td><select name="leave_type" id="type_leave" class="hide">
                                    <option value="Deductible against pay">Deductible against pay</option>
                                    <option value="Vacation leave">Vacation leave</option>
                                    <option value="Sick leave">Sick leave</option>
                                </select>
                                <input type="text" value="{{ $item->leave_type }}" readonly id="leave_type" size="25"></td>
                        </tr>
                        <tr>
                            <td>Date requested: </td>
                            <td>From <input type="date" name="from" id="date_from" value="{{ $item->date_from }}" readonly> to <input type="date" name="to" id="date_to" value="{{ $item->date_to }}" readonly></td>
                        </tr>
                        <tr>
                            <td>Reason:</td>
                            <td><textarea name="reason" id="reason" cols="40" rows="4" readonly>{{ $item->reason }}</textarea></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>
                                <input type="text" name="id" value="{{ $item->id }}" class="hide" readonly>
                                <button type="submit" value="Accept" name="decision"><span><i class="fas fa-check"></i></span> Accept</button>
                                <button type="submit" value="Decline" name="decision"><span><i class="fas fa-times"></i></span> Decline</button>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@endsection