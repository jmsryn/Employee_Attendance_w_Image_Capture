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
        <h2>Undertime Details:</h2>
        <form action="/admin/application_overtime" method="POST">
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
                        <td><input type="text" name="id" value="{{ $item->id }}" class="hide" readonly>
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