<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <form action="search.php" method="post">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </form>
        </div>
        <!-- /.input-group -->
    </div>

    <!-- Blog login -->
    <div class="well">
        <h4>Blog Login</h4>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="login">login</button>
                    </span>
                </div>
            </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories";
                    $all_categories = mysqli_query($connection, $query);
                    if (!$all_categories) {
                        echo "error in connecting to database";
                    }

                    while ($row = mysqli_fetch_assoc($all_categories)) {
                        echo "<li><a href='category.php?category_id={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>
</div>