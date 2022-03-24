<?php
$query = "SELECT * FROM users";
$all_users = mysqli_query($connection, $query);

$count = mysqli_num_rows($all_users);

if (!$count) {
    echo "<h1>No Result Found.</h1>";
} else {

?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Admin</th>
                <th>Subscriber</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($rows = mysqli_fetch_assoc($all_users)) {
                echo "<tr>";
                echo "<td>{$rows['user_id']}</td>";
                echo "<td>{$rows['username']}</td>";
                echo "<td>{$rows['user_firstname']}</td>";
                echo "<td>{$rows['user_lastname']}</td>";
                echo "<td>{$rows['user_email']}</td>";
                echo "<td>{$rows['user_role']}</td>";
                echo "<td>{$rows['user_joined_date']}</td>";
                echo "<td><a href='users.php?source=edit_user&edit_id={$rows['user_id']}'>Edit</a></td>";
                echo "<td><a href='users.php?chg_to_admin={$rows['user_id']}'>Admin</a></td>";
                echo "<td><a href='users.php?chg_to_subscriber={$rows['user_id']}'>Subscriber</a></td>";
                echo "<td><a href='users.php?delete={$rows['user_id']}'>Delete</a></td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
<?php }

if (isset($_GET['chg_to_admin'])) {
    $approve_id = $_GET['chg_to_admin'];
    $approve_query = "UPDATE users SET user_role='admin' WHERE user_id = $approve_id ";
    mysqli_query($connection, $approve_query);
    header("Location:users.php");
}

if (isset($_GET['chg_to_subscriber'])) {
    $unapprove_id = $_GET['chg_to_subscriber'];
    $unapprove_query = "UPDATE users SET user_role='subscriber' WHERE user_id = $unapprove_id ";
    mysqli_query($connection, $unapprove_query);
    header("Location:users.php");
}

if (isset($_GET['delete'])) {
    $query = "DELETE FROM users WHERE user_id = {$_GET['delete']} ";
    mysqli_query($connection, $query);
    header("Location:users.php");
}
?>