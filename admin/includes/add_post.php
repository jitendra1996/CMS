<?php


if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $post_cat_id = $_POST['post_category_id'];
    $author = $_POST['author'];
    $status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image = 'img'.time().'.'.explode('.',$post_image)[1];
    $image_temp = $_FILES['image']['tmp_name'];

    $tags = $_POST['post_tags'];
    $date = date('d-m-y');
    $content = $_POST['post_content'];

    move_uploaded_file($image_temp, "../images/$post_image");


    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES('$post_cat_id','$title','$author',now(),'$post_image','$content','$tags','$status')";

    $post_result = mysqli_query($connection, $query);

    if (!$post_result) {
        die("data not stored" . mysqli_error($connection));
    } else {
        echo "data stored successfully.";
        header("location:posts.php");
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category_id" id="post_category">
            <?php
                $query = "SELECT * FROM categories";
                $all_cats = mysqli_query($connection,$query);
                while($rows = mysqli_fetch_assoc($all_cats)){
                    echo "<option value={$rows['cat_id']}>{$rows['cat_title']}</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="author" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
                <option value="published">Published</option>
                <option value="draft">Draft</option>         
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Publish post" name="create_post" class="btn btn-primary">
    </div>
</form>