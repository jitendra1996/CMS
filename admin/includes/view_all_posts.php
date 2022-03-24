<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Published</th>
            <th>Draft</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $all_posts = mysqli_query($connection, $query);
        $count = mysqli_num_rows($all_posts);
        if (!$count) {
            echo "No Result Found.";
        } else {
            while ($rows = mysqli_fetch_assoc($all_posts)) {
                echo "<tr>";
                echo "<td>{$rows['post_id']}</td>";
                echo "<td>{$rows['post_author']}</td>";
                echo "<td>{$rows['post_title']}</td>";

                $query = "SELECT cat_title FROM categories WHERE cat_id = '{$rows['post_category_id']}' ";
                $cat_res = mysqli_query($connection,$query);
                $result = mysqli_fetch_row($cat_res);
                if($result){
                    echo "<td>{$result[0]}</td>";
                }
                
                echo "<td>{$rows['post_status']}</td>";
                echo "<td><img src='../images/{$rows['post_image']}' class='img-responsive' alt='img1' width='100'></td>";
                echo "<td>{$rows['post_tags']}</td>";
                echo "<td>{$rows['post_comment_count']}</td>";
                echo "<td>{$rows['post_date']}</td>";
                echo "<td><a href='posts.php?published={$rows['post_id']}'>Published</a></td>";
                echo "<td><a href='posts.php?draft={$rows['post_id']}'>Draft</a></td>";
                echo "<td><a href='posts.php?source=edit_post&edit_post={$rows['post_id']}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$rows['post_id']}'>Delete</a></td>";
                echo "</tr>";
            }
        }

        if(isset($_GET['published'])){
            $query = "UPDATE posts SET post_status = 'published' WHERE post_id = {$_GET['published']} ";
            mysqli_query($connection,$query);
            header("Location:posts.php");
        }

        if(isset($_GET['draft'])){
            $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$_GET['draft']} ";
            mysqli_query($connection,$query);
            header("Location:posts.php");
        }

        if(isset($_GET['delete'])){
            $query = "DELETE FROM posts WHERE post_id = {$_GET['delete']} ";
            mysqli_query($connection,$query);
            header("Location:posts.php");
        }
        ?>
    </tbody>
</table>