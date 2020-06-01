@extends('inc.emp_dashboard')
@section('main-content')
<h2>Timesheet</h2>
<form action="">
    <label for="">Search date:</label>
    <input type="date" name="" id="">
    <button type="submit"><span><i class="fas fa-filter"></i></span> Filter</button>
</form>
<table>
    <thead>
        <th>Date</th>
        <th>Time</th>
        <th>Log Type</th>
        <th>Proof</th>
    </thead>
    <tbody>
        @foreach ($timesheet_info as $item)
        <tr>
            <td>{{ $item->date }}</td>
            <td>{{ $item->time }}</td>
            <td>{{ $item->log_type }}</td>
            <td><img id="myImg" src="\upload\{{ $item->proof }}" alt="{{ $item->date }}" width="50px" onclick="wew()"></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="myModal" class="modal">
    <span class="close-x">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>
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