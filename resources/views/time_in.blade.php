<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="\css\picture.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/c01d554147.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <main>
        <form action="/capture/timein" method="POST">
            <div class="container">
                <div class="picture-cell">
                    <div id="my_camera"></div>
                        @csrf
                    <input type="hidden" name="image" class="image-tag">
                </div>
                <div class="emp-details">
                    @foreach ($emp_info as $item)
                    @if ($log_type == 'Time in')
                    <h2>Good morning, {{ $item->first_name }}!</h2>
                    @else
                    <h2>Good afternoon, {{ $item->first_name }}!</h2> 
                    @endif
                    <p class="qoute">"Opportunities are like sunrises. If you wait too long, you miss them" -William Arthur Ward</p>
                    <h3>Time: <?php date_default_timezone_set('Asia/Manila'); echo date("h:i A"); echo ' '; echo date("l"); ?></h3>
                    <h3>Date: <?php echo date("Y/m/d"); ?></h3>
                    <input type="text" name="idnum" class="hide" readonly value="{{ $item->emp_id }}">
                    <input type="text" name="log_type" class="hide" readonly value="{{ $log_type }}">
                    <button id="take-snapchat" onClick="take_snapshot()"><span><i class="fas fa-save"></i></span> Submit</button>
                    @endforeach
                </div>
            </div>
        </form>
    </main>
    
    <script language="JavaScript">
        // var modal = document.getElementById("myModal")
        // var span = document.getElementsByClassName("close")[0]
        // let para = document.getElementById('text')
          
        Webcam.set({
            width: 640,
            height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
      
        Webcam.attach( '#my_camera' );
      
        function take_snapshot() {
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
            } );
            modal.style.display = "block";
            para.innerHTML = "Picture Taken"
        }
        
    </script>
</body>
</html>