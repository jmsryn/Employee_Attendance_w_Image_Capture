@extends('inc.emp_dashboard')
@section('main-content')
<h2>Notifications</h2>
<table>
    <thead>
        <th>Application ID</th>
        <th>Application Type</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($app_details as $item)
            <tr>
                <form action="/notification/{{ $item->type }}/{{ $item->id }}" method="POST">
                    @csrf
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->status }}</td>
                    <td><button type="submit"><span><i class="fas fa-eye"></i></span> Mark as read</button>
                    </td>
                </form>
            </tr>
        @endforeach
    </tbody>
</table>
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