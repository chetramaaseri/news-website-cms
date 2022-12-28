<?php
include('../config.php');

if (!isset($_SESSION['username'])) {
    header("Location:{$HOSTADDRESS}/admin/index.php");
}else{
    header("Location:{$HOSTADDRESS}/admin/post.php");
}
?>