@extends('inc.admin_dashboard')
@section('main-content')
    <h2>Applications for leave requests:</h2>
    <table>
        <thead>
            <th>Application ID</th>
            <th>Employee Name</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($leave_list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                <td>{{ $item->status }}</td>
                <td><a href="/admin/application_leave/view/{{ $item->emp_id }}/{{ $item->id }}" class="button"><span><i class="far fa-eye"></i></span> View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
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