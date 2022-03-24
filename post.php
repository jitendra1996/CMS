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

            if (isset($_GET['p_id'])) {
                $p_id = $_GET['p_id'];
                $query = "SELECT * FROM posts WHERE post_id=$p_id ";
                $all_posts = mysqli_query($connection, $query);

                while ($post = mysqli_fetch_assoc($all_posts)) {
                    $title = $post['post_title'];
                    $author = $post['post_author'];
                    $date = $post['post_date'];
                    $image = $post['post_image'];
                    $content = $post['post_content'];

                    echo "<h2>
                                <a href='post.php?p_id={$post['post_id']}'>{$title}</a>
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
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <?php
                if (isset($_POST['create_comment'])) {
                    $comment_post_id = $p_id;
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
                    $query .= "VALUES('$comment_post_id','$comment_author','$comment_email','$comment_content','unapproved',now())";
                    $comment_query = mysqli_query($connection, $query);

                    if (!$comment_query) {
                        die('Some Error ' . mysqli_error($connection));
                    } else {
                        echo "your commented successfully.";
                    }

                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $p_id";
                    $update_comment_count_query = mysqli_query($connection,$query);
                    
                }
                ?>
                <h4>Leave a Comment:</h4>
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label for="author">username</label>
                        <input type="text" name="comment_author" id="author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" name="comment_email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id = $p_id ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);

            if (!$select_comment_query) {
                die("Query failed" . mysqli_error($connection));
            } else {
                while ($rows = mysqli_fetch_assoc($select_comment_query)) {
                    $comment_date = $rows['comment_date'];
                    $comment_content = $rows['comment_content'];
                    $comment_author = $rows['comment_author'];
            ?>



                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content ; ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>