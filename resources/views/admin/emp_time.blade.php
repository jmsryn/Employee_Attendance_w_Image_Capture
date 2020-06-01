@extends('inc.admin_dashboard')
@section('main-content')
<div class="emp-timesheet" id="empTime">
    @foreach ($emp_info as $item)
    <h2>{{ $item->last_name }}'s Applications</h2>
    @endforeach
    <hr>
    <form action="">
        <label for="">Search date:</label>
        <input type="date" name="" id="">
        <button type="submit"><span><i class="fas fa-filter"></i></span> Search</button>
    </form>
    <table>
        <thead>
            <th>Date</th>
            <th>Time</th>
            <th>Log Type</th>
            <th>Proof</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($timesheet_info as $item)
            <tr>
                <form action="/admintime" style="display: inline" method="POST">
                    @csrf
                    <td><input type="date" name="date" id="date_ts" value="{{ $item->date }}" readonly></td>
                    <td id="time_hide">{{ $item->time }}</td>
                    <td class="hide" id="time_show"><input type="text" name="time" value="{{ $item->time }}" size="10"></td>
                    <td>{{ $item->log_type }}</td>
                    <td><img id="myImg" src="\upload\{{ $item->proof }}" alt="{{ $item->date }}" width="50px" onclick="wew()"></td>
                    <td><input style="font-family: FontAwesome;" type="button" name="timesheet" id="editApp" value="&#xf044; Edit">
                        <input type="text" name="time_id" value="{{ $item->time_sheet_id }}" class="hide">
                        <button class="hide" id="saveApp" type="submit" value="{{ $item->emp_id }}" name="saveApp"><span><i class="fas fa-save"></i></span> Save</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="myModal" class="modal">
    <span class="close-x">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
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
<script>
    const modal = document.getElementById("myModal");
    
    function wew(){
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = img.src;
        captionText.innerHTML = img.alt;
    }
    
    var span = document.getElementsByClassName("close-x")[0];
    
    span.onclick = function() { 
    modal.style.display = "none";
    }
</script>
@endsection
