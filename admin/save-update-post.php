<?php
session_start();
include('config.php');
if (!isset($_SESSION['username'])) {
    header("Location:{$HOSTADDRESS}/admin/index.php");
}
if(isset($_POST['submit'])){
    if(empty($_FILES['new-image']['name'])){
        $file_name = $_POST['old-image'];
    }else{
        $errors = array();
        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $type = $_FILES['new-image']['type'];
        $temp =explode(".", $file_name);
        $file_ext = strtolower(end($temp));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext,$extensions)=== false) {
            $errors[] = "This extention file not allowed, Please choose a JPG or PNG file";
        }
        // file size restriction here 2mb
        if($file_size > 2097152){
            $errors[] = "File size must be 2mb or lower";
        }

        if(empty($errors)==true){
            move_uploaded_file($file_tmp, "upload/" . $file_name);
        }else{
            print_r($errors);
            die(); 
        }
    }

    $sql = "UPDATE post SET title='{$_POST['post_title']}', description='{$_POST['postdesc']}', category={$_POST['category']}, post_img='{$file_name}' WHERE post_id ={$_POST['post_id']}";
    $result = mysqli_query($conn, $sql);
    if($result){
        header(("Location: {$HOSTADDRESS}/admin/post.php"));
    }else{
        echo ("Can't Update Post");
    }
}
?>


