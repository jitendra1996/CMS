<?php


if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $password = $_POST['password'];

    $user_image = $_FILES['user_image']['name'];
    $user_image = 'img' . time() . '.' . explode('.', $user_image)[1];
    $image_temp = $_FILES['user_image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $date = date('d-m-y');
    $user_role = $_POST['user_role'];
    $user_salt_string = $_POST['salt_string'];

    move_uploaded_file($image_temp, "../images/$user_image");


    $query = "INSERT INTO users(username,password,user_firstname,user_lastname,user_email,user_image,user_joined_date,user_role,randsalt) ";
    $query .= "VALUES('$username','$password','$user_firstname','$user_lastname','$user_email','$user_image',now(),'$user_role','$user_salt_string')";

    $post_result = mysqli_query($connection, $query);

    if (!$post_result) {
        die("data not stored" . mysqli_error($connection));
    } else {
        echo "data stored successfully.";
        header("location:users.php");
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <!-- <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category_id" id="post_category">
            <?php
            // $query = "SELECT * FROM categories";
            // $all_cats = mysqli_query($connection,$query);
            // while($rows = mysqli_fetch_assoc($all_cats)){
            //     echo "<option value={$rows['cat_id']}>{$rows['cat_title']}</option>";
            // }
            ?>
        </select>
    </div> -->

    <div class="form-group">
        <label for="username">username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="firatname">Firstname</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="user_email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role">user role</label>
        <select name="user_role" id="user_role">
            <option value="subscriber">Select options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="salt_string">Salt string</label>
        <input type="text" name="salt_string" id="salt_string" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" value="Add User" name="create_user" class="btn btn-primary">
    </div>
</form>