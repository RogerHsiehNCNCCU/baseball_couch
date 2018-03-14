<?php
//$host = 'https://dbadmin.systemdynamics.tw';
//$host = 'localhost';//ajax傳表單到server是外地，在server上的php時使用DB時是本地
$user = 'happy123';
$pass = '123happy';
//	$user = "studDB";
//	$pass = "pwd999";
//用admin帳號登入後才可以新增DB，新增完修改可使用此DB的使用者有誰
//在到mysql->db->新增此資料庫的使用者
//$user = 'a037580238';
//$pass = 'a037582629';
$db = 'happyMVC';
//$db = 'happy123';
//$conn = mysql_connect($host, $user, $pass) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
//mysql_query("SET NAMES utf8", $conn); //選擇編碼
//mysql_select_db($db, $conn); //選擇資料庫
$conn = mysqli_connect($host, $user, $pass, $db) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
mysqli_query($conn,"SET NAMES utf8"); //選擇編碼
//mysqli_connect(host,username,password,dbname,port,socket);
//mysqli_query(connection,query,resultmode);

//改成mysqli_
//select不用了

/*查詢姓名*/
function search_name($conn,$id){
    $sql="select * from grad_book where id='$id'";
    return mysqli_query($conn,$sql);
}
/*查詢畢冊費用*/
function count_fee($fee,$fee_first,$fee_seocnd,$flag){
    $comp=strcmp($fee_first,$fee_seocnd);
    if($flag==1){//計算畢冊費用
        if($fee_first=='00000'){
            return 0;
        }
        else{
            $pos1=strpos($fee_first,'1');//找出要付費的項目
            $pos2=strpos($fee_first,'1',$pos1+1);
            $pos3=strpos($fee_first,'1',$pos2+1);
            //echo("$pos1:".$pos1.",$pos2:".$pos2.",$pos3:".$pos3);
            if(($pos1===$pos2)||($pos2===$pos3)||($pos1===$pos3))
                $total=$fee[$pos1];
            else if(empty($pos3)&&($pos1!=$pos2))
                $total=$fee[$pos1]+$fee[$pos2];
            else
                $total=$fee[$pos1]+$fee[$pos2]+$fee[$pos3];
            return $total;
        }
    }
    else if($flag==2){//計算攝影費用
        if($fee_first=='000'){
            return 0;
        }
        else{
            $pos1=strpos($fee_first,'1');
            $total=$fee[$pos1];
            return $total;
        }
    }
}
?>
