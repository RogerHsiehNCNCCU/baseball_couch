<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript">
</script>
<style type="text/css">
#form{
    position:absolute;
    left:40%;
    top:40%;
}
h1{
    position:absolute;
    left:40%;
}
#go{
    position:absolute;
    left:50%;
}
body{
    background-color:azure;
}
</style>
</head>
<body>
<h1>畢冊、攝影繳費明細</h1>
<div id="form">
<form id="form1" method="post" action="show.php">
<table id="table1">
<tr>
<td>學號：</td>
<td><input type="text" id="user_id" name="user_id"/></td>
</tr>

<tr>
<td><input id="go" type="submit" value="go"/></td>
</tr>
</table>
</form>
</div>


</body>
</html>
