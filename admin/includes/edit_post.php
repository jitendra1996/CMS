<?php
if (isset($_GET['edit_post'])) {
    $post_id = $_GET['edit_post'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id ";
    $res = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($res);
}

if (isset($_POST['update_post'])) {
    $post_id = $_GET['edit_post'];
    $title = $_POST['title'];
    $post_cat_id = $_POST['post_category_id'];
    $author = $_POST['author'];
    $status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    if (!$post_image) {
        $post_image = $data['post_image'];
    } else {
        $post_image = 'img' . time() . '.' . explode('.', $post_image)[1];
    }
    $image_temp = $_FILES['image']['tmp_name'];

    $tags = $_POST['post_tags'];
    $date = date('d-m-y');
    $post_comment_count = 4;
    $content = $_POST['post_content'];

    move_uploaded_file($image_temp, "../images/$post_image");

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$title}', ";
    $query .= "post_category_id = '{$post_cat_id}', ";
    $query .= "post_author = '{$author}', ";
    $query .= "post_status = '{$status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$tags}', ";
    $query .= "post_date = now(), ";
    $query .= "post_content = '{$content}' ";
    $query .= "WHERE post_id =$post_id ";

    $update_post = mysqli_query($connection, $query);

    if (!$update_post) {
        die("data not stored" . mysqli_error($connection));
    } else {
        echo "data stored successfully.";
        header("Location:posts.php");
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" value="<?php echo $data['post_title']; ?>" name="title" id="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category_id">
            <?php
            $query4 = "SELECT * FROM categories";
            $cat_id_query = mysqli_query($connection, $query4);
            if (!$cat_id_query) {
                die("Error " . mysqli_error($connection));
            }
            while ($rows = mysqli_fetch_assoc($cat_id_query)) {
                echo "<option value='{$rows['cat_id']}'>{$rows['cat_title']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="author" value="<?php echo $data['post_author']; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <?php
            echo "<option value='{$data['post_status']}'>{$data['post_status']}</option>";
            if ($data['post_status'] !== 'published') {
                echo "<option value='published'>Published</option>";
            } else {
                echo "<option value='draft'>Draft</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
        <img src="../images/<?php echo $data['post_image']; ?>" alt="img" width="100">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" value="<?php echo $data['post_tags']; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"><?php echo $data['post_content']; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Update post" name="update_post" class="btn btn-primary">
    </div>
</form>