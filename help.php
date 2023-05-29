<?php
session_start();
ob_start();

if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    die();
}
$user = $_SESSION['user'];
include 'header/header.php';

?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 style = "margin-top: 70px">Panel Yardımı</h1>
    <p class="page-header">Panel için yardım.</p>

<div class='panel panel-info'>
    <div class='panel-heading'>
        <h3 class='panel-title'>Oyuncular</h3>
    </div>
    <div class='panel-body'>
        <p>Oyuncular sekmesinde, arama çubuğuyla tamamen aynı bir filtre çubuğu bulunur, bu, bir oyuncu adı veya kullanıcı kimliği aramanıza olanak tanır.</p>
    </div>
</div>

<div class='panel panel-info'>
    <div class='panel-heading'>
        <h3 class='panel-title'>Ban Menü</h3>
    </div>
    <div class='panel-body'>
        <p>Yasak menüsü, bu, oyuna giren / çıkan oyuncuları bir sebep ve bir süre ile yasaklamanıza olanak tanır. Süre dakika, 60 = 1 saat olarak ölçeklendirilir. Not - Bir oyuncu yasaklandığında sunucuda kalacaktır, bu yüzden lütfen hemen sonra onları tekmeleyin!</p>
    </div>
</div>

<div class='panel panel-info'>
    <div class='panel-heading'>
        <h3 class='panel-title'>Kick Menü</h3>
    </div>
        <div class='panel-body'>
        <p>Kick player, bunun iki seçeneği vardır, RCON kick ve Server kick. Sunucu vuruşu, veritabanınızda bulunan her bir oyuncuyla birlikte gelir ve bunu yapmak için ihtiyacınız olan tek şey vuruştur, açıkçası onları tekmelemesi için sunucuda olmaları gerekir.</p>
        <p>RCON vuruşu biraz daha karmaşıktır, ancak vuruşunuz için bir neden verme yeteneğine sahiptir. Birini tekmelemek için oyuncunun Battleye kimliğine ihtiyacınız vardır, bu, battleye listesi düğmesine tıklayarak bulunur. Bu, insanları sunucunuzdan atmak için kullanmanız gereken numaradır - Kullanıcı kimlikleri veya REHBERLERİ değil.</p>
    </div>
</div>

<div class='panel panel-info'>
    <div class='panel-heading'>
        <h3 class='panel-title'>Loglar Menü</h3>
    </div>
    <div class='panel-body'>
        <p>Günlükler sekmesi, tam olarak hangi yöneticinin tam olarak ne yaptığını gösterir. Not - Zamanlama, veritabanınızın bulunduğu yere bağlı olacaktır!</p>
    </div>
</div>

<div class='panel panel-info'>
    <div class='panel-heading'>
        <h3 class='panel-title'>By. Nes!</h3>
    </div>
    <div class='panel-body'>
        <p>Admin panel %90 halini sizler için hazırladım umarım beğenirsiniz</p>
    </div>
</div>


          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
