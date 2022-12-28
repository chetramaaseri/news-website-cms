<?php include "header.php";
include('config.php');
if (!isset($_SESSION['username']) or !$_SESSION['user_role'] == '1') {
    header("Location:{$HOSTADDRESS}/admin/index.php");
}

if(isset($_POST['submit'])){
    $cat_name = mysqli_real_escape_string($conn,strtoupper($_POST['cat_name']));
    $cat_id = $_POST['cat_id'];
   
    $sql1 = "SELECT category_name FROM category WHERE category_name = '{$cat_name}'";
    $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
    if(mysqli_num_rows($result1)>0){
        echo ("<p style='color:red;text-align:center;margin: 10px 0'>Category Already Exists</p>");
    }else{
        $sql2 = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = {$cat_id}";
        $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
        if($result2){
            header("Location:{$HOSTADDRESS}/admin/category.php");
        }else{
            echo ("<p style='color:red;text-align:center;margin: 10px 0'>Can't Update! Try afte sometime</p>");
        }
    }
}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                $category = $_GET['category'];
                $sql = "SELECT * FROM category WHERE category_name = '{$category}'";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                        <div class="form-group">
                            <input type="hidden" name="cat_id"  class="form-control" value="<?php echo ($row['category_id']) ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="cat_name" class="form-control" value="<?php echo ($row['category_name']) ?>"  placeholder="" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    </form>
                    <?php
                    }
                }
                ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
