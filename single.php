<?php include 'header.php';
include('connection.php'); ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                <?php
                $iD = $_GET['id'];
                $sql = "SELECT * FROM post 
                        LEFT JOIN category ON post.post_id = category.category_id
                        LEFT JOIN user on post.author = user.user_id WHERE post_id = {$iD}";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){ ?>
                
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo($row['title']) ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo($row['category_name']) ?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo($row['username']) ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo($row['post_date']) ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo($row['post_img']) ?>" alt=""/>
                            <p class="description">
                            <?php echo($row['description']) ?>
                            </p>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
