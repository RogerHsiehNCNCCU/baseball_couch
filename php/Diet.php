<?php
require_once ('dbconnect.php');

function newplayer($conn){//可用中文
	$pid = mysqli_real_escape_string($conn, $_POST['playerid']);
	$hei = mysqli_real_escape_string($conn, $_POST['hei']);
	$bre = mysqli_real_escape_string($conn, $_POST['bre']);
	$lun = mysqli_real_escape_string($conn, $_POST['lun']);
	$din = mysqli_real_escape_string($conn, $_POST['din']);
	$ext = mysqli_real_escape_string($conn, $_POST['ext']);
    $sql = "INSERT INTO `飲食` (`PID`,`日期`,`早餐`,`午餐`,`晚餐`,`額外補充`) values('$pid','$hei','$bre','$lun','$din','$ext');";
	//不能用"+back+"
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>新增成功!</h1></div>");
}
function showplayer($conn){//顯示查詢結果 注意`XX表格`.`XXattribut` 是要這樣打
    $sql = "SELECT `飲食`.`日期`,`球員`.`名字`,`飲食`.`早餐`,`飲食`.`午餐`,`飲食`.`晚餐`,`飲食`.`額外補充`,`球員`.`PID` FROM `球員`,`飲食` WHERE `球員`.`PID`=`飲食`.`PID` ";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function showwho($conn){//顯示查詢結果 符合特定位置
    $who = mysqli_real_escape_string($conn, $_POST['showwho']);
    $sql = "SELECT `飲食`.`日期`,`球員`.`名字`,`飲食`.`早餐`,`飲食`.`午餐`,`飲食`.`晚餐`,`飲食`.`額外補充`,`球員`.`PID` FROM `球員`,`飲食` WHERE `球員`.`PID`=`飲食`.`PID` and `球員`.`PID`='$who' ";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function deleteplayer($conn){//刪除player
    $del = mysqli_real_escape_string($conn, $_POST['del']);
	$delpid = mysqli_real_escape_string($conn, $_POST['delpid']);
	$sql = "DELETE FROM `飲食` WHERE `日期`='$del' and `PID`='$delpid'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>刪除成功!</h1></div>");
}
function updateplayer($conn){//選出要修改的player
    $upd = mysqli_real_escape_string($conn, $_POST['upd']);
	$updpid = mysqli_real_escape_string($conn, $_POST['updpid']);
	$sql = "SELECT `飲食`.`日期`,`飲食`.`早餐`,`飲食`.`午餐`,`飲食`.`晚餐`,`飲食`.`額外補充`,`球員`.`PID` FROM `飲食`,`球員` WHERE `球員`.`PID`=`飲食`.`PID` and `日期`='$upd' and `飲食`.`PID`='$updpid'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function updateplayer2($conn){//修改player
    $upd2 = mysqli_real_escape_string($conn, $_POST['upd2']);
	$updback = mysqli_real_escape_string($conn, $_POST['updback']);
	$updbre = mysqli_real_escape_string($conn, $_POST['updbre']);
	$updlun = mysqli_real_escape_string($conn, $_POST['updlun']);
	$upddin = mysqli_real_escape_string($conn, $_POST['upddin']);
	$updext = mysqli_real_escape_string($conn, $_POST['updext']);
	$updpid = mysqli_real_escape_string($conn, $_POST['updpid']);
	$sql = "UPDATE `飲食` SET `日期`='$updback' ,`早餐`='$updbre',`午餐`='$updlun',`晚餐`='$upddin',`額外補充`='$updext' WHERE `日期`='$upd2' and `PID`='$updpid'";
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
	input[type="text"] {
	    width:100px;
	}
	#wei,#updhei{
	    width:400px;
	}
	#show,#del,#upd,#upd2,#updpid,#delpid{
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
			<li><a href="Train.php">Train</a></li>
            <li class="active"><a href="Diet.php">Diet</a></li>
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
				<tr><th class='col-md-2'>日期</th><th class='col-md-1'>名字</th><th class='col-md-2'>早餐</th><th class='col-md-2'>午餐</th><th class='col-md-2'>晚餐</th>
                <th class='col-md-2'>額外補充</th><th class='col-md-1'>PID</th><th class='col-md-1'>刪除</th><th class='col-md-1'>修改</th></tr><br/>";
					$result = showplayer($conn);
					while($row = mysqli_fetch_row($result))
					{
						$id = $row[0];$b = $row[1];$bre = $row[2];
						$lun = $row[3];$din = $row[4];$ext = $row[5];$pid=$row[6];
						echo "<tr><td>$id</td><td>$b</td>
						<td>$bre</td><td>$lun</td><td>$din</td><td>$ext</td><td>$pid</td>
						<td><form method='post' action='Diet.php'>
						<input type='text' id='del' name='del' value='$id'/>
						<input type='text' id='delpid' name='delpid' value='$pid'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Diet.php'>
						<input type='text' id='upd' name='upd' value='$id'/>
						<input type='text' id='updpid' name='updpid' value='$pid'/>
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
				<tr><th class='col-md-2'>日期</th><th class='col-md-1'>名字</th><th class='col-md-2'>早餐</th><th class='col-md-2'>午餐</th><th class='col-md-2'>晚餐</th>
				<th class='col-md-2'>額外補充</th><th class='col-md-1'>PID</th><th class='col-md-1'>刪除</th><th class='col-md-1'>修改</th></tr><br/>";
					$result = showwho($conn);
					while($row = mysqli_fetch_row($result))
					{
					    $id = $row[0];$b = $row[1];$bre = $row[2];
						$lun = $row[3];$din = $row[4];$ext = $row[5];$pid=$row[6];
						echo "<tr><td>$id</td><td>$b</td><td>$bre</td><td>$lun</td>
						<td>$din</td><td>$ext</td><td>$pid</td>
						<td><form method='post' action='Diet.php'>
						<input type='text' id='del' name='del' value='$id'/>
						<input type='text' id='delpid' name='delpid' value='$pid'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Diet.php'>
						<input type='text' id='upd' name='upd' value='$id'/>
						<input type='text' id='updpid' name='updpid' value='$pid'/>
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
		    <tr><th class='col-md-2'>日期</th><th class='col-md-2'>早餐</th><th class='col-md-2'>午餐</th><th class='col-md-2'>晚餐</th>
				<th class='col-m<th class='col-md-2'>額外補充</th><th class='col-md-1'>PID</th><th class='col-md-1'>修改</th></tr><br/>";
			$result = updateplayer($conn);
			while($row = mysqli_fetch_row($result))
			{
				$id = $row[0];$bre = $row[1];
				$lun = $row[2];$din = $row[3];$ext = $row[4];$pid=$row[5];
				echo "<tr><td><form method='post' action='Diet.php'>
				<input type='text' id='updback' name='updback' value='$id'></td>
				<td><input type='text' id='updbre' name='updbre' value='$bre'></td>
				<td><input type='text' id='updlun' name='updlun' value='$lun'></td>
				<td><input type='text' id='upddin' name='upddin' value='$din'></td>
				<td><input type='text' id='updext' name='updext' value='$ext'></td>
				<td>$pid</td>
				<td><input type='text' id='upd2' name='upd2' value='$id'/>
				<input type='text' id='updpid' name='updpid' value='$pid'/>
				<input type='submit' value='修改'/>
				</form></td></tr><br/>";
			}
			echo "</table></div>";
		}
		?>
		</div>
        <p class="lead" id="player">新增飲食</p>
		<div class="add">
			<form method="post" action="Diet.php">
				<span>PID:<input type="text" id="playerid" name="playerid"/></span>
				<span>日期:<input type="date" id="hei" name="hei"/></span>
				<span>早餐:<input type="text" id="bre" name="bre"/></span>
				<span>午餐:<input type="text" id="lun" name="lun"/></span>
				<span>晚餐:<input type="text" id="din" name="din"/></span>
				<span>額外補充:<input type="text" id="ext" name="ext"/></span>
				<input type="submit" value="新增"/>
			</form>
		</div>
		<p class="lead" id="player">查詢飲食</p>
		<div class="sel">
			<form method="post" action="Diet.php">
			    <input type="text" id="show" name="show" value="1"/>
				<input type="submit" value="全部查詢"/>
			</form>
			<br/>
			<form method="post" action="Diet.php">
			    <input type="text" id="showwhoe" name="showwho" />&nbsp;
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