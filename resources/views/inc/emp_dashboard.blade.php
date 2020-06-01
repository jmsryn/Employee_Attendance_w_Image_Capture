<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="\css\style.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/c01d554147.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                        @foreach ($emp_name as $item)
                            <p>{{ $item->first_name }} {{ $item->last_name }}</p>
                            <p>Employee</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="nav-items">
                <ul>
                    <li><a href="/dashboard"><span><i class="far fa-clock"></i></span>&nbsp Timesheet</a></li>
                    <li><button id="dropdowntoggle"><span><i class="fas fa-align-left"></i></span>&nbsp Application 
                        @if ( $total_count > 0)
                            <span id="app_notif">{{ $total_count }}</span>
                        @else
                            <i></i>
                        @endif
                        </button></li>
                    <div class="dropDown hide" id="dropClass">
                        <li><a href="/leave"><span><i class="fas fa-money-bill-alt"></i></span>&nbsp For Leave <i></i></a></li>
                        <li><a href="/under"><span><i class="fas fa-clock"></i></span>&nbsp For Undertime <i></i></a></li>
                        <li><a href="/over"><span><i class="fas fa-clock"></i></span>&nbsp For Overtime <i></i></a></li>
                        <li><a href="/notification"><span><i class="fas fa-bell"></i></span>&nbsp Notification 
                            @if ( $total_count > 0)
                            <span>{{ $total_count }}</span>
                            @else
                                <i></i>
                            @endif
                        </a></li>
                        <li><a href="/archive"><span><i class="fas fa-archive"></i></span>&nbsp Archive <i></i></a></li>
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

    <script src="\js\superadmin.js"></script>
</body>
</html>