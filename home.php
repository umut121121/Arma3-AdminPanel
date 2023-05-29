<?php

session_start();
ob_start();

if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    die();
}

$staffPerms = $_SESSION['perms'];
$user = $_SESSION['user'];

$conecG = 'work';
$_SESSION['conecFail'] = $conecG;

include 'verifyPanel.php';
masterconnect();

$players = 0;
$money = 0;

$sqlget = 'SELECT * FROM players';
$sqldata = mysqli_query($dbcon, $sqlget) or die('Connection could not be established');

while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
    ++$players;
    $money = $money + $row['cash'] + $row['bankacc'];
}

$sqlgetVeh = 'SELECT * FROM vehicles';
$sqldataVeh = mysqli_query($dbcon, $sqlgetVeh) or die('Connection could not be established');
$vehicles = mysqli_num_rows($sqldataVeh);

include 'header/header.php';
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 style = "margin-top: 70px">Gösterge paneli</h1>
     	  <p class="page-header">Panelin gösterge tablosu.</p>
<?php
    //Max players
    echo '
    <div class="row">
    <div class="col-md-4">
    ';

    echo    "<div id='rcorners1'>";
    echo        "<div class='box-top'><center><h1>Oyuncular</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo        '<p><br><center>Şu anda var '.$players.' oyuncular sunucuya kaydoldu.</p>';
    echo        '</div>';
    echo    '</div>';

    echo    '</div>';
    echo '<div class="col-md-4">';

    //Vehicles

    echo    "<div id='rcorners2'>";
    echo        "<div class='box-top'><center><h1>Araçlar</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo        '<p><br><center>Şu anda var '.$vehicles.' araçlar.</p>';
    echo        '</div>';
    echo    '</div>';

    echo    '</div>';
    echo '<div class="col-md-4">';

    //?
$money = '$'.number_format($money, 2);

    echo    "<div id='rcorners3'>";
    echo        "<div class='box-top'><center><h1>Toplam Para</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo        '<p><br><center>Toplam var '.$money.' sunucuda.</p>';
    echo        '</div>';
    echo    '</div>';

    echo    '</div>';
    echo    '</div>';
    echo    '<div class="row">';
    echo '<div class="col-lg-4">';

    echo    "<div id='rcorners5'>";
    echo        "<div class='box-top'><center><h1>Sunucu Restart</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=restart value=Restart".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo '<div class="col-lg-4">';

    echo    "<div id='rcorners4'>";
    echo        "<div class='box-top'><center><h1>Genel Mesaj</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textInput'><td>"."<center><input class='form-control' type=text name=global value='' < /td></div><br>";
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=send value=Gönder".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo '<div class="col-lg-4">';

    echo    "<div id='rcorners6'>";
    echo        "<div class='box-top'><center><h1>Sunucuyu Durdur</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=stop value=Dur".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo    '</div>';
    echo    '<div class="row">';
    echo    '<div class="col-md-2">';
    echo    '</div>';
    echo    '<div class="col-lg-4">';

    echo    "<div id='rcorners8'>";
    echo        "<div class='box-top'><center><h1>Yardım</h1></div>";
    echo        "<div class='box-top'><center><h4>Panelde genel yardım için!</h4></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=help value=Yardım".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo '<div class="col-lg-4">';

if (isset($_POST['send'])) {
    if ($staffPerms['globalMessage'] == '1') {
        $send = $_POST['global'];
        $_SESSION['send'] = $send;
        header('Location: rCon/rcon-mess.php');
        $message = 'Admin '.$user.' genel bir mesaj gönderdi ('.$send.')';
        logIt($user, $message, $dbcon);
    } else {
        header('Location: lvlError.php');
        die();
    }
}

if (isset($_POST['restart'])) {
    if ($staffPerms['restartServer'] == '1') {
        $message = 'Admin '.$user.' sunucuyu yeniden başlattı.';
        logIt($user, $message, $dbcon);
        header('Location: rCon/rcon-restart.php');
    } else {
        header('Location: lvlError.php');
        die();
    }
}

if (isset($_POST['stop'])) {
    if ($staffPerms['stopServer'] == '1') {
        $message = 'Admin '.$user.' sunucuyu durdurdu.';
        logIt($user, $message, $dbcon);
        header('Location: rCon/rcon-stop.php');
    } else {
        header('Location: lvlError.php');
        die();
    }
}

if (isset($_POST['help'])) {
    header('Location: help.php');
    die();
}
ob_end_flush();
?>
<div class = "donate">
<div class ="headD"><center><h3>By. Nes <br> Bu Panel %90 Türkçe Yapılmıştır.<h3></center></div>
	<div class ="donateB"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_donations">
	<input type="hidden" name="business" value="info@zentrabot.com">
	<input type="hidden" name="lc" value="GB">
	<input type="hidden" name="item_name" value="AdminPanel">
	<input type="hidden" name="no_note" value="0">
	<input type="hidden" name="currency_code" value="GBP">
	<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
	</form></div>
</div>

</div>
</div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
