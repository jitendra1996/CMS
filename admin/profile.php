<!-- header -->
<?php include "includes/admin_header.php"; ?>
<!-- /header -->
<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username' ";
    $user_query = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($user_query);
}

?>
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

                    <?php if (isset($_POST['update_user'])) {
                        $user_firstname = $_POST['user_firstname'];
                        $user_lastname = $_POST['user_lastname'];
                        $password = $_POST['password'];

                        $user_image = $_FILES['user_image']['name'];
                        if (!$user_image) {
                            $user_image = $data['user_image'];
                        } else {
                            $user_image = 'img' . time() . '.' . explode('.', $user_image)[1];
                        }
                        $image_temp = $_FILES['user_image']['tmp_name'];

                        $user_email = $_POST['user_email'];
                        // $date = date('d-m-y');
                        $user_role = $_POST['user_role'];
                        $salt_string = $_POST['salt_string'];

                        move_uploaded_file($image_temp, "../images/$user_image");

                        $query = "UPDATE users SET ";
                        $query .= "username = '{$username}', ";
                        $query .= "user_firstname = '{$user_firstname}', ";
                        $query .= "user_lastname = '{$user_lastname}', ";
                        $query .= "password = '{$password}', ";
                        $query .= "user_image = '{$user_image}', ";
                        $query .= "user_email = '{$user_email}', ";
                        $query .= "user_role = '{$user_role}', ";
                        $query .= "randsalt = '{$salt_string}' ";
                        $query .= "WHERE username = '$username' ";

                        $update_post = mysqli_query($connection, $query);

                        if (!$update_post) {
                            die("data not stored" . mysqli_error($connection));
                        } else {
                            echo "data stored successfully.";
                            header("Location:users.php");
                        }
                    }

                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">username</label>
                            <input type="text" name="username" value="<?php echo $data['username']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="firatname">Firstname</label>
                            <input type="text" name="user_firstname" value="<?php echo $data['user_firstname']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="user_lastname" value="<?php echo $data['user_lastname']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="user_image">User Image</label>
                            <input type="file" name="user_image">
                            <img src="../images/<?php echo $data['user_image']; ?>" width="100" alt="img">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="user_email" id="email" value="<?php echo $data['user_email']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="user_role">user role</label>
                            <select name="user_role" id="user_role">
                                <?php
                                $query = "SELECT user_role FROM users WHERE username = '$username' ";
                                $all_cats = mysqli_query($connection, $query);
                                $get_user_role = mysqli_fetch_assoc($all_cats);
                                echo "<option value={$get_user_role['user_role']}>{$get_user_role['user_role']}</option>";
                                if($get_user_role['user_role'] !== 'admin'){
                                    echo "<option value='admin'>admin</option>";
                                }else{
                                    echo "<option value='subscriber'>subscriber</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="salt_string">Salt string</label>
                            <input type="text" name="salt_string" id="salt_string" value="<?php echo $data['randsalt']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Update User" name="update_user" class="btn btn-primary">
                        </div>
                    </form>
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