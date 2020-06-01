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
                            <p>Superadmin</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="nav-items">
                <ul>
                    <li><a href="/superadmindashboard"><span><i class="fas fa-users"></i></span>&nbsp Employee List</a></li>
                    <li><a href="/superadminadd"><span><i class="fas fa-user-plus"></i></span>&nbsp Add Employee</a></li>
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
            <div class="box-alert hide" style="background:var(--thirtiary);" id="profileNavTop">
                <div class="profile-nav-top" >
                    <div class="nav-top-left"><span style="color: white; font-size: .8rem;"><i class="fas fa-user"></i> User:<span>James Ryan Gaid</span></span></div>
                    <div class="nav-top-right">
                        <button id="backbtnProfile"><span><i class="fas fa-arrow-circle-left"></i></span> Back</button>
                        <button><span><i class="fas fa-check"></i></span> Save</button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="holding-cell">
                    @yield('main-content')
                </div>
            </div>
        </div>
    </main>

    <script src="\js\superadmin.js"></script>
    <script src="\js\view_apps.js"></script>
</body>
</html>