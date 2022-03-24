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
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">

                        <?php 
                            if(isset($_POST['submit'])){
                                $cat_title = $_POST['cat_title'];

                                if(strlen($cat_title) === 0 || empty($cat_title)){
                                    echo "you didn't enter anything.";
                                }else{
                                    $query = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
                                    $add_cat = mysqli_query($connection,$query);
                                }

                            }
                        ?>

                         <!-- add category form    -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Add Category" name="submit" class="btn btn-primary">
                            </div>
                        </form>
                        <!-- /add category form     -->
                        
                        <!--get cat_title to update category -->
                        <?php
                            if(isset($_GET['update'])){
                                $update_cat_id = $_GET['update'];

                                $query = "SELECT * FROM categories WHERE cat_id = $update_cat_id ";
                                $update_query=mysqli_query($connection,$query);
                                $data = mysqli_fetch_assoc($update_query);
                            }
                        ?>
                        <!-- /get cat_title to update category -->

                        <!-- update category query -->
                        <?php 
                            if(isset($_POST['edit'])){
                                $updated_title = $_POST['updated_cat_title'];
                                
                                $query = "UPDATE categories SET cat_title = '$updated_title' WHERE cat_id = {$_GET['update']} ";
                                $updated_query=mysqli_query($connection,$query);
                                header("Location:categories.php");

                            }
                        ?>
                        <!-- /update category query -->

                        <!-- show form to update category  -->
                        <?php if(isset($_GET['update'])) { ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Edit Category</label>
                                <input type="text" class="form-control" name="updated_cat_title" value="<?php if(isset($data['cat_title'])){echo $data['cat_title'];}?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update Category" name="edit" class="btn btn-primary">
                            </div>
                        </form>
                        <?php } ?>
                        <!-- /show form to update category -->

                    </div>

                    <div class="col-xs-6">
                        <!-- category table -->
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM categories";
                                $all_cat = mysqli_query($connection, $query);

                                if (!$all_cat) {
                                    die("Error");
                                } else {
                                    $count = mysqli_num_rows($all_cat);
                                    if (!$count) {
                                        echo "No Categories.";
                                    } else {
                                        while ($cat = mysqli_fetch_assoc($all_cat)) {
                                            echo "<tr>";
                                            echo "<td>{$cat['cat_id']}</td>";
                                            echo "<td>{$cat['cat_title']}</td>";
                                            echo "<td><a href='categories.php?delete={$cat['cat_id']}'>Delete</a></td>";
                                            echo "<td><a href='categories.php?update={$cat['cat_id']}'>Edit</a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                                ?>
                                <!-- query to delete category from table -->
                                <?php 
                                    if(isset($_GET['delete'])){
                                        $del_id = $_GET['delete'];

                                        $query = "DELETE FROM categories WHERE cat_id = $del_id ";
                                        $del_query = mysqli_query($connection,$query);
                                        header("Location: categories.php");
                                    }
                                ?>
                                <!-- /query to delete category from table -->

                            </tbody>
                        </table>
                        <!-- /category table -->
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- footer -->
<?php include "includes/admin_footer.php"; ?>
<!-- /footer -->