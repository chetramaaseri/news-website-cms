<?php
include('config.php');
if (!isset($_SESSION['username']) or !$_SESSION['user_role'] == '1') {
    header("Location:{$HOSTADDRESS}/admin/index.php");
}
$category = $_GET['category'];
$sql = "DELETE FROM category WHERE category_name = '{$category}'";
$result = mysqli_query($conn, $sql) or die("Query Failed");

if($result){
    header("Location:{$HOSTADDRESS}/admin/category.php");
}else{
    echo ("<p style='color:red;text-align:center;margin: 10px 0'>Can't Delete! Try after sometime</p>");
}
?>

