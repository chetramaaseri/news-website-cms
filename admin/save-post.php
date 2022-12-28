<?php
session_start();
include('config.php');
if (!isset($_SESSION['username'])) {
    header("Location:{$HOSTADDRESS}/admin/index.php");
}

if(isset($_POST['submit'])){
    if(isset($_FILES['fileToUpload'])){
        $errors = array();
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $type = $_FILES['fileToUpload']['type'];
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
    $post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
    $postdesc = mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $date = date("d M, Y");
    $author = $_SESSION['user_id'];

    $sql = "INSERT INTO post (title, description, category, post_date, author, post_img) VALUES ('{$post_title}', '{$postdesc}', {$category}, '{$date}', {$author}, '{$file_name}'); ";
    $sql .= "UPDATE category SET post_count = post_count + 1 WHERE category_id = {$category}";
    if(mysqli_multi_query($conn,$sql)){
        header("Location:{$HOSTADDRESS}/admin/post.php");
    }else{
        echo "<div class='alert alert-danger'>Failed to Save</div>";
    }


}

?>
