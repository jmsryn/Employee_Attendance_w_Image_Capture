<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="\css\capture.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300&display=swap" rel="stylesheet"> 
    {{-- <script src="https://kit.fontawesome.com/c01d554147.js" crossorigin="anonymous"></script> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="/capture/timein/{{ $emp_id }}" method="GET">
            <div class="log-select hide">
                <div class="time-out">
                    <button type="submit" name="selectBtn" value="Time in">Time in</button>
                </div>
                <div class="time-in">
                    <button type="submit" name="selectBtn" value="Time out">Time out</button>
                </div>
            </div>
        </form>
    </main>
</body>
</html>