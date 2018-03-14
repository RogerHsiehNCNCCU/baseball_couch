<?php
//require 'hunt/php/session_start.php';
//require 'hunt/php/dbconnect.php';
//header("Content-Type: text/html; charset=utf-8");
require_once ('db.php');
//require_once ('db2.php');
session_start();
$id=$_POST['user_id'];
$user_data=search_name($conn,$id);
$result=mysqli_fetch_array($user_data);
$result_count=mysqli_num_rows($user_data);
    if($result_count==0||$result_count>1){
        echo "<script type='text/javascript'>
            alert('學號錯誤...');
            window.location.href='check.php';
            </script>";
    }
    else{
        $name=$result['name'];
        $grad_num=$result['grad_book_num'];
        $grad_pay=$result['grad_pay'];
        $photo_num=$result['photo_num'];
        $photo_pay=$result['photo_pay'];
        $photo_pay_re=$result['photo_pay_re'];
        $GLOBALS['grad']=[1300,800,800,200,674];
        $GLOBALS['photo']=[350,100,250];
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript">
</script>
<style type="text/css">
#table1{
    position:absolute;
    left:40%;
    top:30%;
}
#name{
    position:absolute;
    left:45%;
    top:25%;
}
#gred{
    //background-color:wheat;
}
#photo{
    //background-color:palegreen;
}
#payable{
    background-color:wheat;
    color:#FF0F0F;
}
#payed{
    background-color:palegreen;
    color:#4538FF;
}
body{
    background-color:azure;
}
#total{
    background-color:gold;
}
</style>
</head>
<body>
<a id="name"><?php echo($name."，你好")?></a>
<table id="table1" border="1">
<tr>
<td></td>
<th id="payed">實付</th>
<th id="payable">應付</th>
</tr>

<tr>
<th id="gred">畢冊</th>
<!--實付-->
<td id="payed" class="gred">
<?php
$count_result=count_fee($GLOBALS['grad'],$grad_pay,$grad_num,1);
$comp=strcmp(substr($grad_pay,0,4),substr($grad_num,0,4));
if(substr($grad_num,0,4)=='0000')
    echo("沒有購買");
else if((substr($grad_num,0,4)!='0000')&&($comp!=0))
    echo("未付款");
else if(substr($grad_pay,-1)=='1')
    echo($count_result-674);
else
    echo($count_result);
?>
</td>
<!--應付-->
<td id="payable" class="gred">
<?php
/*
$comp=strcmp($grad_num,$grad_pay);
if($grad_num=='00000'){
    echo("沒有購買");
}
else{
    $pos1=strpos($grad_num,'1');
    $pos2=strpos($grad_num,'1',$pos1+1);
    $pos3=strpos($grad_num,'1',$pos2+1);
    if(($pos1==$pos2)||($pos2==$pos3)||($pos1==$pos3))
        $total=$GLOBALS['grad'][$pos1];
    else if(empty($pos3))
        $total=$GLOBALS['grad'][$pos1]+$GLOBALS['grad'][$pos2];
    else
        $total=$GLOBALS['grad'][$pos1]+$GLOBALS['grad'][$pos2]+$GLOBALS['grad'][$pos3];
    echo ($pos1.','.$pos2.','.$pos3.','.$total);
}*/

$count_result=count_fee($GLOBALS['grad'],$grad_num,$grad_pay,1);
if(substr($grad_num,0,4)=='0000')
    echo("沒有購買");
else if((substr($grad_num,-1)=='1')&&(substr($grad_num,0,4)=='0000'))
    echo("沒有購買");
else if(substr($grad_num,-1)=='1')
    echo($count_result-674);
else
    echo($count_result);
?>
</td>
</tr>

<tr>
<th id="point">點點印</th>
<!--實付-->
<td id="payed">
<?php
if(substr($grad_pay,-1)=='1')
    echo(674);
else if((substr($grad_num,-1)=='1')&&(substr($grad_pay,-1)!='1'))
    echo("未付款");
else
    echo("沒有購買");
?>
</td>
<!--應付-->
<td id="payable">
<?php
if(substr($grad_num,-1)=='1')
    echo(674);
else
    echo("沒有購買");
?>
</td>
</tr>

<tr>
<th id="photo">攝影</th>
<!--實付-->
<td id="payed" class="photo">
<?php
$count_result=count_fee($GLOBALS['photo'],$photo_pay,$photo_num,2);
if(($count_result==0)&&($photo_num=='000'))
    echo("沒有購買");
else if(($count_result==0)&&($photo_num!='000'))
    echo("未付款");
else
    echo($count_result);
?>
</td>
<!--應付-->
<td id="payable" class="photo">
<?php
$count_result=count_fee($GLOBALS['photo'],$photo_num,$photo_pay,2);
if($count_result==0)
    echo("沒有購買");
else
    echo($count_result);
?>
</td>
</tr>

<tr>
<th><?php echo("攝影退費")?></th>
<td id="payed">
<?php
if($photo_pay_re=='1')
    echo("100");
else if($photo_pay_re=='2')
    echo("250");
else
    echo("0");
?>
</td>
<td id="payable"></td>
</tr>

<tr>
<th id="total">合計</th>
<td id="total"></td>
<td id="total">
<?php
$total_payable=count_fee($GLOBALS['grad'],$grad_num,$grad_pay,1)+count_fee($GLOBALS['photo'],$photo_num,$photo_pay,2);
$total_payed=count_fee($GLOBALS['grad'],$grad_pay,$grad_num,1)+count_fee($GLOBALS['photo'],$photo_pay,$photo_num,2);
$total=$total_payable-$total_payed;
echo($total);
?>
</td>
</tr>
<tr>
<td><button onclick='window.open("check.php","_top")'>back</button></td>
</tr>
</table>
</body>
</html>
