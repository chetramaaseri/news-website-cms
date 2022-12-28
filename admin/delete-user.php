<?php
include('config.php');
if (!isset($_SESSION['username']) or !$_SESSION['user_role'] == '1') {
    header("Location:{$HOSTADDRESS}/admin/index.php");
}
$user_id = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id = {$user_id}";
$result = mysqli_query($conn, $sql) or die("Query Failed");

if($result){
    header("Location:{$HOSTADDRESS}/admin/users.php");
}else{
    echo ("<p style='color:red;text-align:center;margin: 10px 0'>Can't Delete! Try after sometime</p>");
}
?>

