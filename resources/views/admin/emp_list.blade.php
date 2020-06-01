@extends('inc.admin_dashboard')
@section('main-content')
<div class="emp-list">
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
                        <td><a href="/admintime/{{ $info->emp_id }}" class="button"><span><i class="far fa-eye"></i></span> View</a></td>
                        <td><a href="/adminapp/{{ $info->emp_id }}" class="button"><span><i class="far fa-eye"></i></span> View</a></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection