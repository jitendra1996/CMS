<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php
                
                if(isset($_GET['category_id'])){
                    $category_id = $_GET['category_id'];

                    $query = "SELECT * FROM posts WHERE post_category_id LIKE '%$category_id%' AND post_status = 'published' ";
                    $all_posts = mysqli_query($connection,$query);
                    $count = mysqli_num_rows($all_posts);
                    if($count){
                        while($post=mysqli_fetch_assoc($all_posts)){
                            $post_id = $post['post_id'];
                            $title = $post['post_title'];
                            $author = $post['post_author'];
                            $date = $post['post_date'];
                            $image = $post['post_image'];
                            $content = $post['post_content'];
    
                            echo "<h2>
                                    <a href='post.php?p_id=$post_id'>{$title}</a>
                                </h2>";
                            echo "<p class='lead'>
                                    by <a href='index.php'>$author</a>
                                </p>";
                            echo "<p><span class='glyphicon glyphicon-time'></span> Posted on $date</p>";
                            echo "<hr>";
                            echo "<img class='img-responsive' src='./images/$image' alt='image1'>";        
                            echo "<hr>";
                            echo "<p>$content</p>";
                            echo "<a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";
                            echo "<hr>";
                        }
                    }else{
                        echo "<h1>No Result Found.</h1>";
                    }
                }
                ?>

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include "includes/footer.php"; ?>