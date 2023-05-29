<?php

session_start();
ob_start();
$version = '';

if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    die();
}
$user = $_SESSION['user'];
$id = $_POST['hiddenId'];

include 'verifyPanel.php';
masterconnect();

$sql = "SELECT * FROM `users` WHERE `ID` = $_POST[hiddenId]";
$result = mysqli_query($dbcon, $sql);
$user = $result->fetch_object();

include 'header/header.php';
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 style = "margin-top: 70px">İzin Menüsü</h1>
		<p class="page-header">Panelin izin menüsü, bireysel personel izinlerini değiştirmenize izin verir.</p>

        <div class="btn-group" role="group" aria-label="...">
        <FORM METHOD="LINK" ACTION="staff.php">
        <INPUT class='btn btn-primary btn-outline' TYPE="submit" VALUE="Geri">
        </FORM>
        </div>
        <br><br>
<?php

echo "<div id ='civlic'>";

  if ($user->permissions !== '"[]"' && $user->permissions !== '') {
      $return = explode('],[', $user->permissions);

      echo "<div class='panel panel-info'>
  <div class='panel-heading'>
  <h3 class='panel-title'>İzinler</h3>
  </div>
  <div class='panel-body'>";

      foreach ($return as $value) {
          $val = remove($value);
          $newVal = explode(',', $val);
          if ($newVal[1] == 1) {
              echo "<button type='button' id=".$newVal[0]." class='license btn btn-success btn-sm' style='margin-bottom: 5px;' onClick='post1(this.id);'>".$newVal[0].'</button> ';
          } else {
              echo "<button type='button' id=".$newVal[0]." class='btn btn-danger btn-sm' style='margin-bottom: 5px;' onClick='post(this.id);'>".$newVal[0].'</button> ';
          }
      }

      echo '</div>
      <div class="panel-footer">Değişikliklerin gerçekleşmesi için, personel kullanıcısının şu anda oturum açtıysa yeniden oturum açması gerekir. Ayrıca, süper kullanıcının yalnızca personel sayfalarına erişim sağladığını unutmayın - değerleri değiştirmek için hala başka izinlere ihtiyacınız olduğu anlamına gelir. (IG-Admin = In-Game Oyuncular sayfasındaki yönetici. Logs = Admin Logs, Adamin notlara görür. EditPlayer = Oyunculardaki Oyuncu Düzenleme sayfasındaki her şey.)</div>
      </div>';
  }
echo '</div>';
echo '</div>';
?>
<script>

function post (id)
{
var newid = "#" + id;

	$(newid).toggleClass("btn-danger btn-success");

	$.post('changePerms.php',{id:id,uid:<?php echo $id?>},
	function(data)
	{


	});
}

function post1 (id)
{
var newid = "#" + id;

	 $(newid).toggleClass("btn-danger btn-success");

	var newid = id;
	$.post('changePerms.php',{id:id,uid:<?php echo $id?>},
	function(data)
	{

	});
}

</script>
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
