<?php
session_start();

if (isset($_SESSION['failedLogin'])) {
    if ($_SESSION['failedLogin'] >= 5) {
        header('Location: locked.php');
        die();
    }
}

if (!file_exists('verifyPanel.php')) {
    header('Location: create.php');
    die();
}
?>

<html>
<head>
<title>Admin Panel</title>
<link rel="icon" href="https://i.hizliresim.com/pe1f3wl.png" type="image/x-icon" />
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type ="text/css" href="styles/global.css" />
<link rel="stylesheet" type ="text/css" href="styles/dashboard.css" />

<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scaleable=0" />
<!-- Insert this line above script imports  -->
<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>

<!-- normal script imports etc  -->
<script src="scripts/jquery-1.12.3.min.js"></script>
<script src="scripts/jquery.backstretch.js"></script>
<!-- Insert this line after script imports -->
<script>if (window.module) module = window.module;</script>

<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>




</head>
<body>
<meta name="viewport" content="width=device-width">
<div id="background"></div>
	<div id = "header">
        <div class ="logo"><a href="#">Admin<span>Panel</span></a></div>
		<div class ="logoE"><a href="#">By Nes</a></div>
	</div>
<center><div id="txt"></div></center>
<script>startTime();</script>
<div id = "login">
<form action="login.php" method="post">
<div class="login-block">
    <h1>Admin Panel</h1>
    <input type="text" value="" placeholder="Kullanıcı adı" id="username" name="username"/>
    <input type="password" value="" placeholder="Şifre" id="password" name="password"/>
<?php

if (isset($_COOKIE['conecFail']) && $_COOKIE['conecFail'] == '1') {
    echo'<div style="color:red"><center>Veritabanı bağlantısı başarısız oldu!</center></div>';
}

if (isset($_COOKIE['fail']) && $_COOKIE['fail'] == '1') {
    echo'<div style="color:red"><center>Kullanıcı adı veya şifre yanlış.</center></div>';
}
?>
    <button>Giriş</button>
</div>

</form>
</div>

	<script>
        $.backstretch([
		  "images/img4.jpg",
          "images/img5.jpg",
          "images/img7.jpg",
		  "images/img1.jpg",
          "images/img10.jpg",
          "images/img9.jpg",
		  "images/img3.jpg",
		  "images/img4.jpg",
		  "images/img6.jpg",
		  "images/img8.jpg"
        ], {
            fade: 750,
            duration: 4000
        });
    </script>

</body>
</html>
