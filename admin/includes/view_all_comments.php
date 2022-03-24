<?php
$query = "SELECT * FROM comments";
$all_posts = mysqli_query($connection, $query);

$count = mysqli_num_rows($all_posts);

if (!$count) {
    echo "<h1>No Result Found.</h1>";
} else {

?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($rows = mysqli_fetch_assoc($all_posts)) {
                echo "<tr>";
                echo "<td>{$rows['comment_id']}</td>";
                echo "<td>{$rows['comment_author']}</td>";
                echo "<td>{$rows['comment_content']}</td>";

                // $query = "SELECT cat_title FROM categories WHERE cat_id = '{$rows['post_category_id']}' ";
                // $cat_res = mysqli_query($connection,$query);
                // $result = mysqli_fetch_row($cat_res);
                // if($result){
                //     echo "<td>{$result[0]}</td>";
                // }

                echo "<td>{$rows['comment_email']}</td>";
                echo "<td>{$rows['comment_status']}</td>";

               $query = "SELECT * FROM posts WHERE post_id = {$rows['comment_post_id']} ";
               $get_post_query = mysqli_query($connection,$query);
               $post_title = mysqli_fetch_assoc($get_post_query);       

                echo "<td><a href='../post.php?p_id={$post_title['post_id']}'>{$post_title['post_title']}</a></td>";
                
                
                echo "<td>{$rows['comment_date']}</td>";
                echo "<td><a href='comments.php?approve={$rows['comment_id']}'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove={$rows['comment_id']}'>Unapprove</a></td>";
                echo "<td><a href='comments.php?delete={$rows['comment_id']}'>Delete</a></td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
<?php }

if (isset($_GET['approve'])) {
    $approve_id = $_GET['approve'];
    $approve_query = "UPDATE comments SET comment_status='approved' WHERE comment_id = $approve_id ";
    mysqli_query($connection, $approve_query);
    header("Location:comments.php");
}

if (isset($_GET['unapprove'])) {
    $unapprove_id = $_GET['unapprove'];
    $unapprove_query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = $unapprove_id ";
    mysqli_query($connection, $unapprove_query);
    header("Location:comments.php");
}

if (isset($_GET['delete'])) {
    $query = "DELETE FROM comments WHERE comment_id = {$_GET['delete']} ";
    mysqli_query($connection, $query);
    header("Location:comments.php");
}
?>