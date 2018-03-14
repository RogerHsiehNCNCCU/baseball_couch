<?php
require_once ('dbconnect.php');
function newplayer($back){
    $sql = "INSERT INTO `球員` (`背號`) values("+$back+");";
}
/*
function update_player_trap(){//重設陷阱進度
    $sql="UPDATE `player_data` SET rusa=0,rahaw=0,qyulang=0,tlnga=0 where `pid`=".$pid;
    $result=mysqli_query($conn,$sql);
    return $result;
}
function login($acc,$pwd){//判斷帳密,取得pid
    $sql="SELECT `pid` FROM `player_data` WHERE `acc`='".$acc."' AND `pwd`='".$pwd."'";
    $result=mysqli_query($conn,$sql);
    return $result;
}
function insertinitData(){
    $sql = "INSERT INTO `player_data` (`rusa`,`rahaw`,`qyulang`,`tlnga`,`which`) values(0,0,0,0,0);";
}*/
?>
