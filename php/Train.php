<?php
require_once ('dbconnect.php');

function newplayer($conn){//可用中文
	$pid = mysqli_real_escape_string($conn, $_POST['playerid']);
	$hei = mysqli_real_escape_string($conn, $_POST['hei']);
	$wei = mysqli_real_escape_string($conn, $_POST['wei']);
	$size = mysqli_real_escape_string($conn, $_POST['size']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
    $sql = "INSERT INTO `練習項目` (`PID`,`打擊`,`守備`,`時數`,`其他`) values('$pid','$hei','$wei','$size','$position');";
	//不能用"+back+"
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>新增成功!</h1></div>");
}
function showplayer($conn){//顯示查詢結果 注意`XX表格`.`XXattribut` 是要這樣打
    $sql = "SELECT `練習項目`.`編號`,`球員`.`名字`,`練習項目`.`打擊`,`練習項目`.`守備`,`練習項目`.`時數`,`練習項目`.`其他` FROM `球員`,`練習項目` WHERE `球員`.`PID`=`練習項目`.`PID` ";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function showwho($conn){//顯示查詢結果 符合特定位置
    $who = mysqli_real_escape_string($conn, $_POST['showwho']);
    $sql = "SELECT `練習項目`.`編號`,`球員`.`名字`,`練習項目`.`打擊`,`練習項目`.`守備`,`練習項目`.`時數`,`練習項目`.`其他` FROM `球員`,`練習項目` WHERE `球員`.`PID`=`練習項目`.`PID` and `球員`.`PID`='$who' ";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function deleteplayer($conn){//刪除player
    $del = mysqli_real_escape_string($conn, $_POST['del']);
	$sql = "DELETE FROM `練習項目` WHERE `編號`='$del'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>刪除成功!</h1></div>");
}
function updateplayer($conn){//選出要修改的player
    $upd = mysqli_real_escape_string($conn, $_POST['upd']);
	$sql = "SELECT `編號`,`打擊`,`守備`,`時數`,`其他` FROM `練習項目` WHERE `編號`='$upd'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function updateplayer2($conn){//修改player
    $upd2 = mysqli_real_escape_string($conn, $_POST['upd2']);
	$updback = mysqli_real_escape_string($conn, $_POST['updback']);
	$updhei = mysqli_real_escape_string($conn, $_POST['updhei']);
	$updwei = mysqli_real_escape_string($conn, $_POST['updwei']);
	$updsize = mysqli_real_escape_string($conn, $_POST['updsize']);
	$updposition = mysqli_real_escape_string($conn, $_POST['updposition']);
	$sql = "UPDATE `練習項目` SET `打擊`='$updback' ,`守備`='$updhei',`時數`='$updwei',`其他`='$updsize' WHERE `編號`='$upd2'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>修改成功!</h1></div>");
}
if(isset($_POST['playerid'])){
    newplayer($conn);
}
if(isset($_POST['del'])){
    deleteplayer($conn);
}
if(isset($_POST['upd2'])){
    updateplayer2($conn);
}
?>
<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="../img/icon1.jpg">
	<title>棒壘球教練系統</title>
	<!-- Bootstrap core CSS -->
	<link href="../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="../css/starter-template.css" rel="stylesheet">
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="../js/ie-emulation-modes-warning.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="../jQuery/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="../jQuery/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../jQuery/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../jQuery/jquery-ui-touch-punch-master/jquery.ui.touch-punch.min.js"></script><!--要在ui後-->
	<script type="text/javascript" src="../greensock-js/src/minified/TweenMax.min.js"></script>
	
	<script type="text/javascript" src="../js/public.js"></script>
	<script type="text/javascript" src="../js/Train.js"></script>
    <style>
	body{
	margin : 0px 0px 0px 0px; /*去掉周圍的白色*/
	height:100%;width:100%;
	}
	#Title{
	    position:absolute;
		top:-5%;left:25%;
		font-size: 75pt;
		font-family: "Bookman Old Style";
	}
	.bg{
	z-index:0;
	top:0;
	left:0;
	}
	#div{
		position:absolute;
		overflow-y:hidden;
		overflow-x:hidden;
	}
	.bottomback{height:100%;Width:100%;z-index:-10}

	body{
		cursor:url("../img/cursor01.jpg");
	}
	input[type="text"] {
	    width:50px;
	}
	#show,#del,#upd,#upd2{
	    display:none;
	}
	.bdvoice{
	    position:float;
		float:right;
		top:20%;
	}
	</style>
	</head>
    <!--<body onload="show()">-->
	<!--<body id="body" onresize="screenResize()">-->
	<body id="body" >
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.html">棒壘球教練系統</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../index.html">Home</a></li>
            <li><a href="player.php">Player</a></li>
            <li><a href="Game.php">Game</a></li>
			<li class="active"><a href="Train.php">Train</a></li>
            <li><a href="Diet.php">Diet</a></li>
			<li><a target="_blank" href="../fullcalendar-2.6.0/test.html">Schedule</a></li>
            <li><a href="Scout.php">Scout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
	    <div class="bdvoice"><img width="40px" height="auto" src="../img/voice.png" onclick="changeMusic()"></img></div>
      <div class="starter-template">
	    <div class="row" > 
			<?php 
				if(isset($_POST['show'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><th class='col-md-1'>編號</th><th class='col-md-1'>名字</th><th class='col-md-1'>打擊</th><th class='col-md-1'>守備</th>
				<th class='col-md-1'>時數</th><th class='col-md-1'>其他</th><th class='col-md-1'>刪除</th><th class='col-md-1'>修改</th></tr><br/>";
					$result = showplayer($conn);
					while($row = mysqli_fetch_row($result))
					{
						$id = $row[0];$b = $row[1];$n = $row[2];
						$h = $row[3];$w=$row[4];$s=$row[5];
						echo "<tr><td>$id</td><td>$b</td><td>$n</td>
						<td>$h</td><td>$w</td><td>$s</td>
						<td><form method='post' action='Train.php'>
						<input type='text' id='del' name='del' value='$id'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Train.php'>
						<input type='text' id='upd' name='upd' value='$id'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
						 /*echo "$row[0] - 名字(帳號)：$row[1], " . 
						 "電話：$row[3], 地址：$row[4], 備註：$row[5]<br>";*/
					}
					echo "</table></div>";
				}
				if(isset($_POST['showwho'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><th class='col-md-1'>編號</th><th class='col-md-1'>名字</th><th class='col-md-1'>打擊</th><th class='col-md-1'>守備</th>
				<th class='col-md-1'>時數</th><th class='col-md-1'>其他</th><th class='col-md-1'>刪除</th><th class='col-md-1'>修改</th></tr><br/>";
					$result = showwho($conn);
					while($row = mysqli_fetch_row($result))
					{
					    $id = $row[0];$b = $row[1];$n = $row[2];
						$h = $row[3];$w=$row[4];$s=$row[5];
						echo "<tr><td>$id</td><td>$b</td><td>$n</td>
						<td>$h</td><td>$w</td><td>$s</td>
						<td><form method='post' action='Train.php'>
						<input type='text' id='del' name='del' value='$id'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Train.php'>
						<input type='text' id='upd' name='upd' value='$id'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
					}
					echo "</table></div>";
				}
			?>
		<?php
		if(isset($_POST['upd'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		    <tr><th class='col-md-1'>打擊</th><th class='col-md-1'>守備</th>
				<th class='col-md-1'>時數</th><th class='col-md-1'>其他</th><th class='col-md-1'>修改</th></tr><br/>";
			$result = updateplayer($conn);
			while($row = mysqli_fetch_row($result))
			{
				$id = $row[0];$b = $row[1];
				$h = $row[2];$w=$row[3];$s=$row[4];
				echo "<tr><td><form method='post' action='Train.php'>
				<input type='text' id='updback' name='updback' value='$b'></td>
				<td><input type='text' id='updhei' name='updhei' value='$h'></td>
				<td><input type='text' id='updwei' name='updwei' value='$w'></td>
				<td><input type='text' id='updsize' name='updsize' value='$s'></td>
				<td><input type='text' id='upd2' name='upd2' value='$id'/>
				<input type='submit' value='修改'/>
				</form></td></tr><br/>";
			}
			echo "</table></div>";
		}
		?>
		</div>
        <p class="lead" id="player">新增練習項目</p>
		<div class="add">
			<form method="post" action="Train.php">
				<span>PID:<input type="text" id="playerid" name="playerid"/></span>
				<span>打擊:<input type="text" id="hei" name="hei"/></span>
				<span>守備:<input type="text" id="wei" name="wei"/></span>
				<span>時數:<input type="text" id="size" name="size"/></span>
				<span>其他:<input type="text" id="position" name="position"/></span>
				<input type="submit" value="新增"/>
			</form>
		</div>
		<p class="lead" id="player">查詢練習項目</p>
		<div class="sel">
			<form method="post" action="Train.php">
			    <input type="text" id="show" name="show" value="1"/>
				<input type="submit" value="全部查詢"/>
			</form>
			<br/>
			<form method="post" action="Train.php">
			    <input type="text" id="showwho" name="showwho" />&nbsp;
				<input type="submit" value="依PID查詢"/>
			</form>
		</div>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	<!--<p id="Title">棒壘球教練系統</p>-->
	<!--<img id="homebutton" src="../img/button/homebutton.png" onclick="goHome()" height="65" width="65">-->
	<!--<img id="bg" class="bg" src="img/background01.jpg" >-->
    </div>
	</body>
</html>