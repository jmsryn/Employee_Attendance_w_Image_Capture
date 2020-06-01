@extends('inc.admin_dashboard')
@section('main-content')
<div class="emp-application" id="empApp">
    @foreach ($emp_info as $item)
    <h2>{{ $item->last_name }}'s Applications</h2>
    @endforeach
    <hr>
    <br>
    <div class="emp-app-container">
        <div class="emp-app-list">
            <table>
                <thead>
                    <th>Application ID</th>
                    <th>Application Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($app_list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->status }}</td>
                            <td>@if ($item->type == "Leave")
                                    <a href="/admin/leave_view/{{ $emp_id }}/{{ $item->id }}" class="button"><span><i class="far fa-eye"></i></span> View</a>
                                @elseif ($item->type == "Undertime")
                                    <a href="/admin/undertime_view/{{ $emp_id }}/{{ $item->id }}" class="button"><span><i class="far fa-eye"></i></span> View</a>
                                @else
                                    <a href="/admin/overtime_view/{{ $emp_id }}/{{ $item->id }}" class="button"><span><i class="far fa-eye"></i></span> View</a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection