@extends('inc.emp_dashboard')
@section('main-content')
<a href="/archive" class="button"><span><i class="fas fa-arrow-circle-left"></i></span></a>
<h2 style="display: inline">Application for overtime</h2>
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
            <table>
                <tbody>
                    @foreach ($over_details as $item)
                    <tr>
                        <td>Date requested: </td>
                        <td><input type="date" name="date_req" id="" value="{{ $item->date }}" disabled></td>
                    </tr>
                    <tr>
                        <td>Hours: </td>
                        <td><input type="number" name="hours" id="" value="{{ $item->hours }}" disabled></td>
                    </tr>
                    <tr>
                        <td>Reason:</td>
                        <td><textarea name="reason" id="" cols="40" rows="4" disabled>{{ $item->reason }}</textarea></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
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