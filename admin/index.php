<!-- header -->
<?php include "includes/admin_header.php"; ?>
<!-- /header -->

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>
    <!-- /Navigation -->

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        $query = "SELECT COUNT(*) as count FROM posts";
                                        $total_posts_query = mysqli_query($connection, $query);
                                        if (!$total_posts_query) {
                                            die("Query failed" . mysqli_error($connection));
                                        } else {
                                            $posts_count = mysqli_fetch_assoc($total_posts_query)['count'];
                                            echo $posts_count;
                                        }
                                        ?>
                                    </div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        $query = "SELECT * FROM comments";
                                        $total_comments_query = mysqli_query($connection, $query);
                                        if (!$total_comments_query) {
                                            die("Query Failed" . mysqli_error($connection));
                                        } else {
                                            $comments_count = mysqli_num_rows($total_comments_query);
                                            echo $comments_count;
                                        }
                                        ?>
                                    </div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        $query = "SELECT COUNT(*) as count FROM users";
                                        $total_users_query = mysqli_query($connection, $query);
                                        if (!$total_users_query) {
                                            die("Query failed" . mysqli_error($connection));
                                        } else {
                                            $users_count = mysqli_fetch_assoc($total_users_query)['count'];
                                            echo $users_count;
                                        }
                                        ?>
                                    </div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        $query = "SELECT COUNT(*) as count FROM categories";
                                        $total_categories_query = mysqli_query($connection, $query);
                                        if (!$total_categories_query) {
                                            die("Query failed" . mysqli_error($connection));
                                        } else {
                                            $categories_count = mysqli_fetch_assoc($total_categories_query)['count'];
                                            echo $categories_count;
                                        }
                                        ?>
                                    </div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php
                            // active posts query            
                            $query = "SELECT COUNT(*) as count FROM posts WHERE post_status = 'published' ";
                            $post_active_query = mysqli_query($connection, $query);
                            $active_posts_count = mysqli_fetch_assoc($post_active_query)['count'];

                            //draft posts query
                            $query = "SELECT COUNT(*) as count FROM posts WHERE post_status = 'draft' ";
                            $post_draft_query = mysqli_query($connection, $query);
                            $draft_posts_count = mysqli_fetch_assoc($post_draft_query)['count'];

                            // approved comments cout query
                            $query = "SELECT COUNT(*) as count FROM comments WHERE comment_status = 'approved' ";
                            $comment_approved_query = mysqli_query($connection, $query);
                            $approved_comments_count = mysqli_fetch_assoc($comment_approved_query)['count'];

                            // unapproved comments count query
                            $query = "SELECT COUNT(*) as count FROM comments WHERE comment_status = 'unapproved' ";
                            $comment_unapproved_query = mysqli_query($connection, $query);
                            $unapproved_comments_count = mysqli_fetch_assoc($comment_unapproved_query)['count'];

                            //admin users query
                            $query = "SELECT COUNT(*) as count FROM users WHERE user_role = 'admin' ";
                            $user_admin_query = mysqli_query($connection, $query);
                            $admin_users_count = mysqli_fetch_assoc($user_admin_query)['count'];

                            // subscribers user query
                            $query = "SELECT COUNT(*) as count FROM users WHERE user_role = 'subscriber' ";
                            $user_subscriber_query = mysqli_query($connection, $query);
                            $subscriber_users_count = mysqli_fetch_assoc($user_subscriber_query)['count'];



                            $element_text = ['Active Posts', 'Draft Posts', 'Approved Comments', 'Unapproved Comments', 'Admins', 'Subscribres', 'Categories'];
                            $element_count = [$active_posts_count, $draft_posts_count, $approved_comments_count, $unapproved_comments_count, $admin_users_count, $subscriber_users_count, $categories_count];

                            for ($i = 0; $i < count($element_count); $i++) {
                                echo "['{$element_text[$i]}'" . "," . "$element_count[$i]],";
                            }

                            ?>
                            
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- footer -->
<?php include "includes/admin_footer.php"; ?>
<!-- /footer -->