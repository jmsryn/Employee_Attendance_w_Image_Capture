@extends('inc.superadmin_dashboard')
@section('main-content')
<div class="emp-list" id="empList">
    <h2>Employee List</h2>
    <form action="">
        <label for="">Search employee: </label>
        <input type="text" name="" id="">
        <button type="submit"><span><i class="fas fa-search"></i></span> Search</button>
    </form>
    <table>
        <thead>
            <th>Emp_id</th>
            <th>Fullname</th>
            <th>Department</th>
            <th>Profile</th>
            <th>Timesheet</th>
            <th>Application</th>
        </thead>
        <tbody>
            @foreach ($emp_infos as $item)
                @foreach ($item as $info)
                    <tr>
                        <td>{{ $info->emp_id }}</td>
                        <td>{{ $info->first_name }} <span>{{ $info->last_name }}</span> </td>
                        <td>{{ $info->dept_name }}</td>
                        <td>
                            <a href="/superadminprofile/{{ $info->emp_id }}" class="button"><span><i class="far fa-eye"></i></span> View</a>
                        </td>
                        <td><a href="/superadmintime/{{ $info->emp_id }}" class="button"><span><i class="far fa-eye"></i></span> View</a></td>
                        <td><a href="/superadminapp/{{ $info->emp_id }}" class="button"><span><i class="far fa-eye"></i></span> View</a></td>
                    </tr> 
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection