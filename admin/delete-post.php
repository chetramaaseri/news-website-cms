<?php
session_start();
include('config.php');
$postId = $_GET['id'];
// ($postId!=$_SESSION['user_id'] and !$_SESSION['user_role'] == '1')
if (!isset($_SESSION['username'])) {
    header("Location:{$HOSTADDRESS}/admin/post.php");
}
// Restrict to delete others post if they aren't admin
$sql = "SELECT * FROM post WHERE post_id = {$postId}";
$result = mysqli_query($conn, $sql) or die("Query Failed");
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['author'] != $_SESSION['user_id'] and !$_SESSION['user_role'] == '1') {
            header("Location:{$HOSTADDRESS}/admin/post.php");
        } else {
            // unlink used to delete img from folder
            // unlink('uploads/' . $row['post_img']);
            $sql1 = "DELETE FROM post WHERE post_id = {$postId};";
            $sql1 .= "UPDATE category SET post_count = post_count-1 WHERE category_id = {$row['category']}";
            $result1 = mysqli_multi_query($conn, $sql1);
            if ($result1) {
                header("Location:{$HOSTADDRESS}/admin/post.php");
            } else {
                echo ("Can't Delete");
            }
        }
    }
}






?>