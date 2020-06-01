@extends('inc.emp_dashboard')
@section('main-content')
    <h2>Archives</h2>
    <hr>
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
                <td>{{ $item->id }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="/archive/{{ $item->type }}/{{ $item->id }}" class="button"><span><i class="fas fa-eye"></i></span> View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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