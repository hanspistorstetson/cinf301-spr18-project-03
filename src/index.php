<?php
include 'controller.php';
session_start();
//if (isset($_SERVER['HTTP_COOKIE'])) {
//    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
//    foreach($cookies as $cookie) {
//        $parts = explode('=', $cookie);
//        $name = trim($parts[0]);
//        setcookie($name, '', time()-1000);
//        setcookie($name, '', time()-1000, '/');
//    }
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Sliding Puzzle</title>
</head>

<body>
    <div class="container rounded">
        <h1 id="heading">Hans Pistor</h1>
        <br/>
        <div class="content">
            <?php game()?>
        </div>
        <h1 id="solved" style="color: green"></h1>

        <br>
        <button id="random" class="btn btn-primary btn-lg" onclick="randomize()">Randomize</button>
        <br/>
        <br/>
        <div class="row reference-container">
            <div class="col reference">
                <h4>Web</h4>
            </div>
            <div class="col midreference">
                <h4>Development</h4>
            </div>
            <div class="col reference">
                <h4>Applications</h4>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
</body>

</html>