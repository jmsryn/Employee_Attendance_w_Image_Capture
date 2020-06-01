<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/capture.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/c01d554147.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="/capture" method="POST">
            @csrf
            <div class="container">
                <div class="input-form" id="form">
                    @if (session()->has('notif'))
                    <div class="notif" id="notif">
                        <div class="profile-nav-top" >
                            <div class="notif-msg">
                                <p><span>Notification:</span>{{ session()->get('notif') }}</p>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="idnum" id="idnum"">
                    @else
                        <input type="text" name="idnum" id="idnum"">
                    @endif
                </div>
                <div class="input-number" id="number">
                    <table>
                        <tbody>
                            <tr>
                                <td><input type="button" value="1" id="1"></input></td>
                                <td><input type="button" value="2" id="2"></input></td>
                                <td><input type="button" value="3" id="3"></input></td>
                            </tr>
                            <tr>
                                <td><input type="button" value="4" id="4"></input></td>
                                <td><input type="button" value="5" id="5"></input></td>
                                <td><input type="button" value="6" id="6"></input></td>
                            </tr>
                            <tr>
                                <td><input type="button" value="7" id="7"></input></td>
                                <td><input type="button" value="8" id="8"></input></td>
                                <td><input type="button" value="9" id="9"></input></td>
                            </tr>
                            <tr>
                                <td><button type="reset"><span><i class="fas fa-backspace"></i></span></button></td>
                                <td><input type="button" value="0" id="0"></input></td>
                                <td><button type="submit" id="selectBtn"><span><i class="fas fa-sign-in-alt"></i></span></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </main>
    <script src="js/keyboard.js"></script>
</body>
</html>