<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="login">
        <img src="img/jd.png" class="jd">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Username</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email">
            
            <label>Password</label>
            <input type="password" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">
            <input type="submit" id="btn" value="{{ __('Login') }}">
            <a href="#">Forgot password?</a>
            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </form>
    </div>
    
</body>
</html>