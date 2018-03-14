<?php
require_once ('dbconnect.php');

function newGame($conn){//可用中文
    $date = mysqli_real_escape_string($conn, $_POST['date']);
	$field = mysqli_real_escape_string($conn, $_POST['field']);
	$host = mysqli_real_escape_string($conn, $_POST['host']);
	$guest = mysqli_real_escape_string($conn, $_POST['guest']);
	$score = mysqli_real_escape_string($conn, $_POST['score']);
	$formal = mysqli_real_escape_string($conn, $_POST['formal']);
    $sql = "INSERT INTO `比賽` (`日期`,`球場`,`客隊`,`主隊`,`比數`,`判斷比賽型態`) values('$date','$field','$guest','$host','$score','$formal');";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>新增成功!</h1></div>");
}
function newBat($conn){
    $BGID = mysqli_real_escape_string($conn, $_POST['BGID']);
	$BPID = mysqli_real_escape_string($conn, $_POST['BPID']);
	$host = mysqli_real_escape_string($conn, $_POST['straightout']);
	$guest = mysqli_real_escape_string($conn, $_POST['host']);
	$score = mysqli_real_escape_string($conn, $_POST['score']);
	$formal = mysqli_real_escape_string($conn, $_POST['formal']);
	$batcount = mysqli_real_escape_string($conn, $_POST['batcount']);
	$batpoint = mysqli_real_escape_string($conn, $_POST['batpoint']);
    $sql = "INSERT INTO `比賽選手打擊` (`GID`,`PID`,`三振次數`,`全壘打`,`安打`,`打席數`,`打數`,`打點`) values('$BGID','$BPID','$host','$guest','$score','$formal','$batcount','$batpoint');";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>新增成功!</h1></div>");
}
function newPitch($conn){
    $PGID = mysqli_real_escape_string($conn, $_POST['PGID']);
	$PPID = mysqli_real_escape_string($conn, $_POST['PPID']);
	$host = mysqli_real_escape_string($conn, $_POST['straightout']);
	$guest = mysqli_real_escape_string($conn, $_POST['host']);
	$score = mysqli_real_escape_string($conn, $_POST['score']);
	$formal = mysqli_real_escape_string($conn, $_POST['formal']);
	$batcount = mysqli_real_escape_string($conn, $_POST['batcount']);
    $sql = "INSERT INTO `比賽選手投球` (`GID`,`PID`,`局數`,`投球數`,`三振數`,`保送數`,`失誤數`) values('$PGID','$PPID','$host','$guest','$score','$formal','$batcount');";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>新增成功!</h1></div>");
}
function newDefend($conn){
    $DGID = mysqli_real_escape_string($conn, $_POST['DGID']);
	$DPID = mysqli_real_escape_string($conn, $_POST['DPID']);
	$host = mysqli_real_escape_string($conn, $_POST['straightout']);
	$guest = mysqli_real_escape_string($conn, $_POST['host']);
	$score = mysqli_real_escape_string($conn, $_POST['score']);
    $sql = "INSERT INTO `比賽選手防守` (`GID`,`PID`,`局數`,`失誤數`,`守備次數`) values('$DGID','$DPID','$host','$guest','$score');";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>新增成功!</h1></div>");
}
function showGame($conn){//顯示查詢結果
    $sql = "SELECT `GID`,`日期`,`球場`,`客隊`,`主隊`,`比數`,`判斷比賽型態` FROM `比賽` ";//全部都取的話不設where
	$result = mysqli_query($conn,$sql);
	return $result;
}
function showhost($conn){//顯示查詢結果 符合特定位置
    $showhost = mysqli_real_escape_string($conn, $_POST['showhost']);
    $sql = "SELECT `GID`,`日期`,`球場`,`客隊`,`主隊`,`比數`,`判斷比賽型態` FROM `比賽`  WHERE `主隊`='$showhost'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function showBat($conn){//顯示查詢結果
    $sql = "SELECT `比賽選手打擊`.`GID`,`球員`.`名字`,`比賽選手打擊`.`三振次數`,`比賽選手打擊`.`全壘打`,`比賽選手打擊`.`安打`,`比賽選手打擊`.`打席數`,`比賽選手打擊`.`打數`,`比賽選手打擊`.`打點`,`比賽選手打擊`.`PID` FROM `比賽選手打擊`,`球員` WHERE `比賽選手打擊`.`PID` = `球員`.`PID` ";//全部都取的話不設where
	$result = mysqli_query($conn,$sql);
	return $result;
}
function showBatper($conn){//顯示查詢結果
    $showBatper = mysqli_real_escape_string($conn, $_POST['showBatper']);
    $sql = "SELECT COUNT(`比賽選手打擊`.`GID`),`球員`.`名字`,SUM(`比賽選手打擊`.`三振次數`),SUM(`比賽選手打擊`.`全壘打`),SUM(`比賽選手打擊`.`安打`),SUM(`比賽選手打擊`.`打席數`),SUM(`比賽選手打擊`.`打數`),SUM(`比賽選手打擊`.`打點`),`比賽選手打擊`.`PID` FROM `比賽選手打擊`,`球員` WHERE `比賽選手打擊`.`PID` = `球員`.`PID` and `比賽選手打擊`.`PID`='$showBatper'";//全部都取的話不設where
	$result = mysqli_query($conn,$sql);
	return $result;
}
function showPitch($conn){//顯示查詢結果
    $sql = "SELECT `比賽選手投球`.`GID`,`球員`.`名字`,`比賽選手投球`.`三振數`,`比賽選手投球`.`保送數`,`比賽選手投球`.`失誤數`,`比賽選手投球`.`局數`,`比賽選手投球`.`投球數`,`比賽選手投球`.`PID` FROM `比賽選手投球`,`球員` WHERE `比賽選手投球`.`PID` = `球員`.`PID` ";//全部都取的話不設where
	$result = mysqli_query($conn,$sql);
	return $result;
}
function showDefend($conn){//顯示查詢結果
    $sql = "SELECT `比賽選手防守`.`GID`,`球員`.`名字`,`比賽選手防守`.`失誤數`,`比賽選手防守`.`守備次數`,`比賽選手防守`.`局數`,`比賽選手防守`.`PID` FROM `比賽選手防守`,`球員` WHERE `比賽選手防守`.`PID` = `球員`.`PID` ";//全部都取的話不設where
	$result = mysqli_query($conn,$sql);
	return $result;
}
function deleteGame($conn){//刪除Game
    $del = mysqli_real_escape_string($conn, $_POST['del']);
	$sql = "DELETE FROM `比賽` WHERE `GID`='$del'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>刪除成功!</h1></div>");
}
function updateGame($conn){//選出要修改的Game
    $upd = mysqli_real_escape_string($conn, $_POST['upd']);
	$sql = "SELECT `GID`,`日期`,`球場`,`客隊`,`主隊`,`比數`,`判斷比賽型態` FROM `比賽` WHERE `GID`='$upd'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function updateGame2($conn){//修改Game
    $upd2 = mysqli_real_escape_string($conn, $_POST['upd2']);
	$updGame = mysqli_real_escape_string($conn, $_POST['updGame']);
	$updfield = mysqli_real_escape_string($conn, $_POST['updfield']);
	$updguest = mysqli_real_escape_string($conn, $_POST['updguest']);
	$updhost = mysqli_real_escape_string($conn, $_POST['updhost']);
	$updscore = mysqli_real_escape_string($conn, $_POST['updscore']);
	$updformal = mysqli_real_escape_string($conn, $_POST['updformal']);
	$sql = "UPDATE `比賽` SET `日期`='$updGame',`球場`='$updfield',`客隊`='$updguest',`主隊`='$updhost',`比數`='$updscore',`判斷比賽型態`='$updformal' WHERE `GID`='$upd2'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>修改成功!</h1></div>");
}
function deleteBat($conn){//刪除Game
    $delBatp = mysqli_real_escape_string($conn, $_POST['delBatp']);
	$delBatg = mysqli_real_escape_string($conn, $_POST['delBatg']);
	$sql = "DELETE FROM `比賽選手打擊` WHERE `GID`='$delBatg' and `PID`='$delBatp'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>刪除成功!</h1></div>");
}
function deletePitch($conn){//刪除Game
    $delPitchp = mysqli_real_escape_string($conn, $_POST['delPitchp']);
	$delPitchg = mysqli_real_escape_string($conn, $_POST['delPitchg']);
	$sql = "DELETE FROM `比賽選手投球` WHERE `GID`='$delPitchg' and `PID`='$delPitchp'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>刪除成功!</h1></div>");
}
function deleteDefend($conn){//刪除Game
    $delDefendp = mysqli_real_escape_string($conn, $_POST['delDefendp']);
	$delDefendg = mysqli_real_escape_string($conn, $_POST['delDefendg']);
	$sql = "DELETE FROM `比賽選手防守` WHERE `GID`='$delDefendg' and `PID`='$delDefendp'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>刪除成功!</h1></div>");
}
function updateBat($conn){//選出要修改的Game
    $updBatp = mysqli_real_escape_string($conn, $_POST['updBatp']);
	$updBatg = mysqli_real_escape_string($conn, $_POST['updBatg']);
	$sql = "SELECT `比賽選手打擊`.`GID`,`球員`.`名字`,`比賽選手打擊`.`三振次數`,`比賽選手打擊`.`全壘打`,`比賽選手打擊`.`安打`,`比賽選手打擊`.`打席數`,`比賽選手打擊`.`打數`,`比賽選手打擊`.`打點`,`比賽選手打擊`.`PID` FROM `比賽選手打擊`,`球員` WHERE `比賽選手打擊`.`PID` = `球員`.`PID` and `比賽選手打擊`.`GID`='$updBatg' and `比賽選手打擊`.`PID`='$updBatp'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function updateBat2($conn){//修改Game
    $updBatp2 = mysqli_real_escape_string($conn, $_POST['updBatp2']);
	$updBatg2 = mysqli_real_escape_string($conn, $_POST['updBatg2']);
	//$updGame = mysqli_real_escape_string($conn, $_POST['updGame']);
	$updfield = mysqli_real_escape_string($conn, $_POST['updfield']);
	$updguest = mysqli_real_escape_string($conn, $_POST['updguest']);
	$updhost = mysqli_real_escape_string($conn, $_POST['updhost']);
	$updscore = mysqli_real_escape_string($conn, $_POST['updscore']);
	$updformal = mysqli_real_escape_string($conn, $_POST['updformal']);
	$updbatpoint = mysqli_real_escape_string($conn, $_POST['updbatpoint']);
	$sql = "UPDATE `比賽選手打擊` SET `三振次數`='$updfield',`全壘打`='$updguest',`安打`='$updhost',`打席數`='$updscore',`打數`='$updformal',`打點`='$updbatpoint' WHERE `GID`='$updBatg2' and `PID`='$updBatp2'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>修改成功!</h1></div>");
}
function updatePitch($conn){//選出要修改的Game
    $updPitchp = mysqli_real_escape_string($conn, $_POST['updPitchp']);
	$updPitchg = mysqli_real_escape_string($conn, $_POST['updPitchg']);
	$sql = "SELECT `比賽選手投球`.`GID`,`球員`.`名字`,`比賽選手投球`.`三振數`,`比賽選手投球`.`保送數`,`比賽選手投球`.`失誤數`,`比賽選手投球`.`局數`,`比賽選手投球`.`投球數`,`比賽選手投球`.`PID` FROM `比賽選手投球`,`球員` WHERE `比賽選手投球`.`PID` = `球員`.`PID` and `比賽選手投球`.`GID`='$updPitchg' and `比賽選手投球`.`PID`='$updPitchp'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function updatePitch2($conn){//修改Game
    $updPitchp2 = mysqli_real_escape_string($conn, $_POST['updPitchp2']);
	$updPitchg2 = mysqli_real_escape_string($conn, $_POST['updPitchg2']);
	//$updGame = mysqli_real_escape_string($conn, $_POST['updGame']);
	$updfield = mysqli_real_escape_string($conn, $_POST['updfield']);
	$updguest = mysqli_real_escape_string($conn, $_POST['updguest']);
	$updhost = mysqli_real_escape_string($conn, $_POST['updhost']);
	$updscore = mysqli_real_escape_string($conn, $_POST['updscore']);
	$updformal = mysqli_real_escape_string($conn, $_POST['updformal']);
	//$updbatpoint = mysqli_real_escape_string($conn, $_POST['updbatpoint']);
	$sql = "UPDATE `比賽選手投球` SET `三振數`='$updfield',`保送數`='$updguest',`失誤數`='$updhost',`局數`='$updscore',`投球數`='$updformal' WHERE `GID`='$updPitchg2' and `PID`='$updPitchp2'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>修改成功!</h1></div>");
}
function updateDefend($conn){//選出要修改的Game
    $updDefendp = mysqli_real_escape_string($conn, $_POST['updDefendp']);
	$updDefendg = mysqli_real_escape_string($conn, $_POST['updDefendg']);
	$sql = "SELECT `比賽選手防守`.`GID`,`球員`.`名字`,`比賽選手防守`.`失誤數`,`比賽選手防守`.`守備次數`,`比賽選手防守`.`局數`,`比賽選手防守`.`PID` FROM `比賽選手防守`,`球員` WHERE `比賽選手防守`.`PID` = `球員`.`PID` and `比賽選手防守`.`GID`='$updDefendg' and `比賽選手防守`.`PID`='$updDefendp'";
	$result = mysqli_query($conn,$sql);
	return $result;
}
function updateDefend2($conn){//修改Game 
    $updDefendp2 = mysqli_real_escape_string($conn, $_POST['updDefendp2']);
	$updDefendg2 = mysqli_real_escape_string($conn, $_POST['updDefendg2']);
	//$updGame = mysqli_real_escape_string($conn, $_POST['updGame']);
	$updfield = mysqli_real_escape_string($conn, $_POST['updfield']);
	$updguest = mysqli_real_escape_string($conn, $_POST['updguest']);
	$updhost = mysqli_real_escape_string($conn, $_POST['updhost']);
	$updscore = mysqli_real_escape_string($conn, $_POST['updscore']);
	$updformal = mysqli_real_escape_string($conn, $_POST['updformal']);
	$updbatpoint = mysqli_real_escape_string($conn, $_POST['updbatpoint']);
	$sql = "UPDATE `比賽選手防守` SET `失誤數`='$updfield',`守備次數`='$updguest',`局數`='$updhost' WHERE `GID`='$updDefendg2' and `PID`='$updDefendp2'";
	mysqli_query($conn,$sql);
	echo("<div class='starter-template'><h1>修改成功!</h1></div>");
}
if(isset($_POST['date'])){
    newGame($conn);
}
if(isset($_POST['del'])){
    deleteGame($conn);
}
if(isset($_POST['upd2'])){
    updateGame2($conn);
}
if(isset($_POST['BGID'])){
    newBat($conn);
}
if(isset($_POST['PGID'])){
    newPitch($conn);
}
if(isset($_POST['DGID'])){
    newDefend($conn);
}
if(isset($_POST['delBatp']) && isset($_POST['delBatg'])){
    deleteBat($conn);
}
if(isset($_POST['updBatp2']) && isset($_POST['updBatg2'])){
    updateBat2($conn);
}
if(isset($_POST['delPitchp']) && isset($_POST['delPitchg'])){
    deletePitch($conn);
}
if(isset($_POST['updPitchp2']) && isset($_POST['updPitchg2'])){
    updatePitch2($conn);
}
if(isset($_POST['delDefendp']) && isset($_POST['delDefendg'])){
    deleteDefend($conn);
}
if(isset($_POST['updDefendp2']) && isset($_POST['updDefendg2'])){
    updateDefend2($conn);
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
	<script type="text/javascript" src="../js/Game.js"></script>
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
	    width:70px;
	}
	#show,#del,#upd,#upd2,#updBatg,#delBatg,#updPitchg,#delPitchg,#updDefendg,#delDefendg,#showBat,#showPitch,#showDefend,#updBatp,#delBatp,#updPitchp,#delPitchp,#updDefendp,#delDefendp{
	    display:none;
	}
	#updBatp2,#updBatg2,#updPitchp2,#updPitchg2,#updDefendp2,#updDefendg2{
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
            <li class="active"><a href="Game.php">Game</a></li>
			<li><a href="Train.php">Train</a></li>
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
				<tr><td class='col-md-1'>GID</td><td class='col-md-2'>日期</td><td class='col-md-1'>球場</td><td class='col-md-2'>客隊</td><td class='col-md-2'>主隊</td>
				<td class='col-md-1'>比數</td><td class='col-md-1'>正式賽(是:1 否:0)</td><td class='col-md-1'>刪除</td><td class='col-md-1'>修改</td></tr><br/>";
					$result = showGame($conn);
					while($row = mysqli_fetch_row($result))
					{
						$id = $row[0];$G = $row[1];$f = $row[2];
						$gue = $row[3];$hos=$row[4];$sco=$row[5];$for=$row[6];
						echo "<tr><td>$id</td><td>$G</td><td>$f</td><td>$gue</td>
						<td>$hos</td><td>$sco</td><td>$for</td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='del' name='del' value='$id'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='upd' name='upd' value='$id'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
						 /*echo "$row[0] - 球場(帳號)：$row[1], " . 
						 "電話：$row[3], 地址：$row[4], 備註：$row[5]<br>";*/
					}
					echo "</table></div>";
				}
				if(isset($_POST['showhost'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><td class='col-md-1'>GID</td><td class='col-md-2'>日期</td><td class='col-md-1'>球場</td><td class='col-md-2'>客隊</td><td class='col-md-2'>主隊</td>
				<td class='col-md-1'>比數</td><td class='col-md-1'>正式賽(是:1 否:0)</td><td class='col-md-1'>刪除</td><td class='col-md-1'>修改</td></tr><br/>";
					$result = showhost($conn);
					while($row = mysqli_fetch_row($result))
					{
						$id = $row[0];$G = $row[1];$f = $row[2];
						$gue = $row[3];$hos=$row[4];$sco=$row[5];$for=$row[6];
						echo "<tr><td>$id</td><td>$G</td><td>$f</td><td>$gue</td>
						<td>$hos</td><td>$sco</td><td>$for</td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='del' name='del' value='$id'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='upd' name='upd' value='$id'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
					}
					echo "</table></div>";
				}
				if(isset($_POST['showBat'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><td class='col-md-1'>GID</td><td class='col-md-1'>PID</td><td class='col-md-2'>球員姓名</td><td class='col-md-1'>三振次數</td><td class='col-md-1'>全壘打</td><td class='col-md-1'>安打</td>
				<td class='col-md-1'>打席數</td><td class='col-md-1'>打數</td><td class='col-md-1'>打點</td><td class='col-md-1'>打擊率</td><td class='col-md-1'>刪除</td><td class='col-md-1'>修改</td></tr><br/>";
					$result = showBat($conn);
					while($row = mysqli_fetch_row($result))
					{
						$gid = $row[0];$G = $row[1];$f = $row[2];$gue = $row[3];$hos=$row[4];
						$sco=$row[5];$for=$row[6];$batpoint=$row[7];$pid=$row[8];
						$batratio = ($gue + $hos) / (float)$sco;
						echo "<tr><td>$gid</td><td>$pid</td><td>$G</td><td>$f</td><td>$gue</td>
						<td>$hos</td><td>$sco</td><td>$for</td><td>$batpoint</td><td>$batratio</td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='delBatg' name='delBatg' value='$gid'/>
						<input type='text' id='delBatp' name='delBatp' value='$pid'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='updBatg' name='updBatg' value='$gid'/>
						<input type='text' id='updBatp' name='updBatp' value='$pid'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
						 /*echo "$row[0] - 球場(帳號)：$row[1], " . 
						 "電話：$row[3], 地址：$row[4], 備註：$row[5]<br>";*/
					}
					echo "</table></div>";
				}
				if(isset($_POST['showPitch'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><td class='col-md-1'>GID</td><td class='col-md-1'>PID</td><td class='col-md-2'>球員姓名</td><td class='col-md-1'>三振數</td><td class='col-md-1'>保送數</td><td class='col-md-1'>失誤數</td>
				<td class='col-md-1'>局數</td><td class='col-md-1'>投球數</td><td class='col-md-1'>刪除</td><td class='col-md-1'>修改</td></tr><br/>";
					$result = showPitch($conn);
					while($row = mysqli_fetch_row($result))
					{
						$gid = $row[0];$G = $row[1];$f = $row[2];$gue = $row[3];$hos=$row[4];
						$sco=$row[5];$for=$row[6];$pid=$row[7];
						echo "<tr><td>$gid</td><td>$pid</td><td>$G</td><td>$f</td><td>$gue</td>
						<td>$hos</td><td>$sco</td><td>$for</td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='delPitchg' name='delPitchg' value='$gid'/>
						<input type='text' id='delPitchp' name='delPitchp' value='$pid'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='updPitchg' name='updPitchg' value='$gid'/>
						<input type='text' id='updPitchp' name='updPitchp' value='$pid'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
						 /*echo "$row[0] - 球場(帳號)：$row[1], " . 
						 "電話：$row[3], 地址：$row[4], 備註：$row[5]<br>";*/
					}
					echo "</table></div>";
				}
				if(isset($_POST['showDefend'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><td class='col-md-1'>GID</td><td class='col-md-1'>PID</td><td class='col-md-2'>球員姓名</td><td class='col-md-1'>失誤數</td><td class='col-md-1'>守備次數</td><td class='col-md-1'>局數</td>
				<td class='col-md-1'>防守成功率</td><td class='col-md-1'>刪除</td><td class='col-md-1'>修改</td></tr><br/>";
					$result = showDefend($conn);
					while($row = mysqli_fetch_row($result))
					{
						$gid = $row[0];$G = $row[1];$f = $row[2];$gue = $row[3];$hos=$row[4];
						$pid=$row[5];  $Defendratio = ($gue-$f) / (float)$gue;
						echo "<tr><td>$gid</td><td>$pid</td><td>$G</td><td>$f</td><td>$gue</td>
						<td>$hos</td><td>$Defendratio</td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='delDefendg' name='delDefendg' value='$gid'/>
						<input type='text' id='delDefendp' name='delDefendp' value='$pid'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='updDefendg' name='updDefendg' value='$gid'/>
						<input type='text' id='updDefendp' name='updDefendp' value='$pid'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
						 /*echo "$row[0] - 球場(帳號)：$row[1], " . 
						 "電話：$row[3], 地址：$row[4], 備註：$row[5]<br>";*/
					}
					echo "</table></div>";
				}
				if(isset($_POST['showBatper'])){
				echo "<div class='col-md-12 col-md-offset-1'>
				<table class='table-bordered'>
				<tr><td class='col-md-1'>比賽場數</td><td class='col-md-1'>PID</td><td class='col-md-2'>球員姓名</td><td class='col-md-1'>三振次數</td><td class='col-md-1'>全壘打</td><td class='col-md-1'>安打</td>
				<td class='col-md-1'>打席數</td><td class='col-md-1'>打數</td><td class='col-md-1'>打點</td><td class='col-md-1'>打擊率</td><td class='col-md-1'>刪除</td><td class='col-md-1'>修改</td></tr><br/>";
					$result = showBatper($conn);
					while($row = mysqli_fetch_row($result))
					{
						$gid = $row[0];$G = $row[1];$f = $row[2];$gue = $row[3];$hos=$row[4];
						$sco=$row[5];$for=$row[6];$batpoint=$row[7];$pid=$row[8];
						$batratio = ($gue + $hos) / (float)$sco;
						echo "<tr><td>$gid</td><td>$pid</td><td>$G</td><td>$f</td><td>$gue</td>
						<td>$hos</td><td>$sco</td><td>$for</td><td>$batpoint</td><td>$batratio</td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='delBatg' name='delBatg' value='$gid'/>
						<input type='text' id='delBatp' name='delBatp' value='$pid'/>
						<input type='submit' value='刪除'/>
						</form></td>
						<td><form method='post' action='Game.php'>
						<input type='text' id='updBatg' name='updBatg' value='$gid'/>
						<input type='text' id='updBatp' name='updBatp' value='$pid'/>
						<input type='submit' value='修改'/>
						</form></td></tr><br/>";
						 /*echo "$row[0] - 球場(帳號)：$row[1], " . 
						 "電話：$row[3], 地址：$row[4], 備註：$row[5]<br>";*/
					}
					echo "</table></div>";
				}
			?>
		<?php
		if(isset($_POST['upd'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		    <tr><td class='col-md-2'>日期</td><td class='col-md-1'>球場</td><td class='col-md-2'>客隊</td><td class='col-md-2'>主隊</td>
				<td class='col-md-1'>比數</td><td class='col-md-1'>正式賽(是:1 否:0)</td><td class='col-md-1'>修改</td></tr><br/>";
			$result = updateGame($conn);
			while($row = mysqli_fetch_row($result))
			{
				$id = $row[0];$G = $row[1];$f = $row[2];
				$gue = $row[3];$hos=$row[4];$sco=$row[5];$for=$row[6];
				echo "<tr><td><form method='post' action='Game.php'>
				<input type='text' id='updGame' name='updGame' value='$G'></td>
				<td><input type='text' id='updfield' name='updfield' value='$f'></td>
				<td><input type='text' id='updguest' name='updguest' value='$gue'></td>
				<td><input type='text' id='updhost' name='updhost' value='$hos'></td>
				<td><input type='text' id='updscore' name='updscore' value='$sco'></td>
				<td><input type='text' id='updformal' name='updformal' value='$for'></td>
				<td><input type='text' id='upd2' name='upd2' value='$id'/>
				<input type='submit' value='修改'/>
				</form></td></tr><br/>";
			}
			echo "</table></div>";
		}
		if(isset($_POST['updBatg'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		    <tr><td class='col-md-1'>GID</td><td class='col-md-1'>PID</td><td class='col-md-2'>球員姓名</td><td class='col-md-1'>三振次數</td><td class='col-md-1'>全壘打</td><td class='col-md-1'>安打</td>
				<td class='col-md-1'>打席數</td><td class='col-md-1'>打數</td><td class='col-md-1'>打點</td><td class='col-md-1'>修改</td></tr><br/>";
			$result = updateBat($conn);
			while($row = mysqli_fetch_row($result))
			{
				$gid = $row[0];$G = $row[1];$f = $row[2];$gue = $row[3];$hos=$row[4];
						$sco=$row[5];$for=$row[6];$batpoint=$row[7];$pid=$row[8];
				echo "<tr><td><form method='post' action='Game.php'>
				$gid</td>
				<td>$pid</td>
				<td>$G</td>
				<td><input type='text' id='updfield' name='updfield' value='$f'></td>
				<td><input type='text' id='updguest' name='updguest' value='$gue'></td>
				<td><input type='text' id='updhost' name='updhost' value='$hos'></td>
				<td><input type='text' id='updscore' name='updscore' value='$sco'></td>
				<td><input type='text' id='updformal' name='updformal' value='$for'></td>
				<td><input type='text' id='updbatpoint' name='updbatpoint' value='$batpoint'></td>
				<td><input type='text' id='updBatp2' name='updBatp2' value='$pid'/>
				<input type='text' id='updBatg2' name='updBatg2' value='$gid'/>
				<input type='submit' value='修改'/>
				</form></td></tr><br/>";
			}
			echo "</table></div>";
		}
		if(isset($_POST['updPitchg'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		    <tr><td class='col-md-1'>GID</td><td class='col-md-1'>PID</td><td class='col-md-2'>球員姓名</td><td class='col-md-1'>三振數</td><td class='col-md-1'>保送數</td><td class='col-md-1'>失誤數</td>
				<td class='col-md-1'>局數</td><td class='col-md-1'>投球數</td><td class='col-md-1'>修改</td></tr><br/>";
			$result = updatePitch($conn);
			while($row = mysqli_fetch_row($result))
			{
				$gid = $row[0];$G = $row[1];$f = $row[2];$gue = $row[3];$hos=$row[4];
						$sco=$row[5];$for=$row[6];$pid=$row[7];
				echo "<tr><td><form method='post' action='Game.php'>
				$gid</td>
				<td>$pid</td>
				<td>$G</td>
				<td><input type='text' id='updfield' name='updfield' value='$f'></td>
				<td><input type='text' id='updguest' name='updguest' value='$gue'></td>
				<td><input type='text' id='updhost' name='updhost' value='$hos'></td>
				<td><input type='text' id='updscore' name='updscore' value='$sco'></td>
				<td><input type='text' id='updformal' name='updformal' value='$for'></td>
				<td><input type='text' id='updBatp2' name='updPitchp2' value='$pid'/>
				<input type='text' id='updBatg2' name='updPitchg2' value='$gid'/>
				<input type='submit' value='修改'/>
				</form></td></tr><br/>";
			}
			echo "</table></div>";
		}
		if(isset($_POST['updDefendg'])){
		echo "<div class='col-md-12 col-md-offset-1'>
		<table class='table-bordered'>
		    <tr><td class='col-md-1'>GID</td><td class='col-md-1'>PID</td><td class='col-md-2'>球員姓名</td><td class='col-md-1'>失誤數</td><td class='col-md-1'>守備次數</td><td class='col-md-1'>局數</td>
			<td class='col-md-1'>修改</td></tr><br/>";
			$result = updateDefend($conn);
			while($row = mysqli_fetch_row($result))
			{
				$gid = $row[0];$G = $row[1];$f = $row[2];$gue = $row[3];$hos=$row[4];
				$pid=$row[5];
				echo "<tr><td><form method='post' action='Game.php'>
				$gid</td>
				<td>$pid</td>
				<td>$G</td>
				<td><input type='text' id='updfield' name='updfield' value='$f'></td>
				<td><input type='text' id='updguest' name='updguest' value='$gue'></td>
				<td><input type='text' id='updhost' name='updhost' value='$hos'></td>
				<td><input type='text' id='updDefendp2' name='updDefendp2' value='$pid'/>
				<input type='text' id='updDefendg2' name='updDefendg2' value='$gid'/>
				<input type='submit' value='修改'/>
				</form></td></tr><br/>";
			}
			echo "</table></div>";
		}
		?>
		</div>
        <p class="lead" id="Game">新增比賽</p>
		<div class="add">
			<form method="post" action="Game.php">
				<span>日期:<input type="date" id="date" name="date"/></span>
				<span>球場:<input type="text" id="field" name="field"/></span>
				<span>客隊:<input type="text" id="guest" name="guest"/></span>
				<span>主隊:<input type="text" id="host" name="host"/></span>
				<span>比數(客:主):<input type="text" id="score" name="score"/></span>
				<span>正式賽(是:1 否:0):<input type="text" id="formal" name="formal"/></span>
				<input type="submit" value="新增"/>
			</form>
		</div>
		<p class="lead" id="Game">查詢比賽</p>
		<div class="sel">
			<form method="post" action="Game.php">
			    <input type="text" id="show" name="show" value="1"/>
				<input type="submit" value="全部查詢"/>
			</form>&nbsp;&nbsp;&nbsp;
			<form method="post" action="Game.php">
			    <input type="text" id="showhost" name="showhost" value="中信兄弟"/>&nbsp;
				<input type="submit" value="依主隊查詢"/>
			</form>
		</div>
		<p class="lead" id="Game">新增球員比賽打擊資料</p>
		<div class="addbat">
			<form method="post" action="Game.php">
				<span>GID(比賽編號):<input type="text" id="BGID" name="BGID"/></span>
				<span>PID(球員編號):<input type="text" id="BPID" name="BPID"/></span>
				<span>三振次數:<input type="text" id="straightout" name="straightout"/></span>
				<span>全壘打:<input type="text" id="host" name="host"/></span>
				<span>安打:<input type="text" id="score" name="score"/></span>
				<span>打席數:<input type="text" id="formal" name="formal"/></span>
				<span>打數:<input type="text" id="batcount" name="batcount"/></span>
				<span>打點:<input type="text" id="batpoint" name="batpoint"/></span>
				<input type="submit" value="新增"/>
			</form>
		</div>
		<p class="lead" id="Game">新增球員比賽投球資料</p>
		<div class="addpitch">
			<form method="post" action="Game.php">
				<span>GID(比賽編號):<input type="text" id="PGID" name="PGID"/></span>
				<span>PID(球員編號):<input type="text" id="PPID" name="PPID"/></span>
				<span>局數:<input type="text" id="straightout" name="straightout"/></span>
				<span>投球數:<input type="text" id="host" name="host"/></span>
				<span>三振數:<input type="text" id="score" name="score"/></span>
				<span>保送數:<input type="text" id="formal" name="formal"/></span>
				<span>失誤數:<input type="text" id="batcount" name="batcount"/></span>
				<input type="submit" value="新增"/>
			</form>
		</div>
		<p class="lead" id="Game">新增球員比賽防守資料</p>
		<div class="adddefend">
			<form method="post" action="Game.php">
				<span>GID(比賽編號):<input type="text" id="DGID" name="DGID"/></span>
				<span>PID(球員編號):<input type="text" id="DPID" name="DPID"/></span>
				<span>局數:<input type="text" id="straightout" name="straightout"/></span>
				<span>失誤數:<input type="text" id="host" name="host"/></span>
				<span>守備次數:<input type="text" id="score" name="score"/></span>
				<input type="submit" value="新增"/>
			</form>
		</div>
		<p class="lead" id="Game">查詢比賽各項資料</p>
		<div class="sel">
			<form method="post" action="Game.php">
			    <input type="text" id="showBat" name="showBat" value="1"/>
				<input type="submit" value="打擊查詢"/>
			</form>
			<form method="post" action="Game.php">
			    <span>球員PID:<input type="text" id="showBatper" name="showBatper" /></span>
				<input type="submit" value="個人總體打擊查詢"/>
			</form>
			<form method="post" action="Game.php">
			    <input type="text" id="showPitch" name="showPitch" value="1"/>
				<input type="submit" value="投球查詢"/>
			</form>
			<form method="post" action="Game.php">
			    <input type="text" id="showDefend" name="showDefend" value="1"/>
				<input type="submit" value="防守查詢"/>
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