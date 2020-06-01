<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="\css\style.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/c01d554147.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="navbar">
            <div class="logo">
                <img src="\img\jd.png" alt="" width="100px" height="100px">
            </div>
            <div class="emp-info">
                <div class="emp-container">
                    <div class="pp">
                        <img src="\storage\images\{{ Auth::user()->avatar }}" alt="" width="50px" height="50px">
                    </div>
                    <div class="emp-details">
                        @foreach ($hr_names as $item)
                            <p>{{ $item->first_name }} {{ $item->last_name }}</p>
                            <p>Admin</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="nav-items">
                <ul>
                    <li><a href="/admindashboard"><span><i class="far fa-clock"></i></span>&nbsp Timesheet</a></li>
                    <li><button id="dropdowntoggle"><span><i class="fas fa-align-left"></i></span>&nbsp Application 
                            @if ( $total_count > 0)
                                <span id="app_notif">{{ $total_count }}</span>
                            @else
                            <i></i>
                            @endif
                            </button></li>
                    <div class="dropDown hide" id="dropClass">
                        <li><a href="/admin/application_leave"><span><i class="fas fa-money-bill-alt"></i></span>&nbsp For Leave 
                            @if ( $leave_count > 0)
                                <span>{{ $leave_count }}</span>
                            @else
                            <i></i>
                            @endif
                        </a></li>
                        <li><a href="/admin/application_undertime"><span><i class="fas fa-clock"></i></span>&nbsp For Undertime 
                            @if ( $under_count > 0)
                                <span>{{ $under_count }}</span>
                            @else
                                <i></i>
                            @endif
                        </a></li>
                        <li><a href="/admin/application_overtime"><span><i class="fas fa-clock"></i></span>&nbsp For Overtime 
                            @if ( $over_count > 0)
                                <span>{{ $over_count }}</span>
                            @else
                            <i></i>
                            @endif
                        </a></li>
                    </div>
                    <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><span><i class="fas fa-sign-out-alt"></i></span>&nbsp {{ __('Logout') }}</a></li>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </ul>
            </div>
        </div>
        <div class="main-container">
            <div class="box-alert"></div>
            <div class="container">
                <div class="holding-cell">
                    @yield('main-content')
                </div>
            </div>
        </div>
    </main>

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
    <script src="\js\view_apps.js"></script>
</body>
</html>