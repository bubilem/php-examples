<?php
error_reporting(E_ALL);
require "functions/db.php";
require "functions/html.php";
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbDatabase = 'db_user_administration';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User administration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>User administration</h1>
        <?php
        $action = 'show';
        $db = db_init($dbHost, $dbUser, $dbPassword, $dbDatabase);

        //User deleting from DB
        if (filter_input(INPUT_POST, 'action') === 'del') {
            db_delete_user($db);
        } else if (filter_input(INPUT_GET, 'action') === 'del') {
            $user = db_load_user($db);
            if (is_array($user) && !empty($user)) {
                echo '<h2>Delete User</h2>';
                echo '<p><a href="index.php" title="back to table">&#10096;</a></p>';
                html_yes_no_form('Are you sure to delete user ' . $user['surname'] . '?', ['action' => 'del', 'id' => $user['id']]);
                $action = '';
            } else {
                echo '<p class="alert">User not found.</p>';
            }
        }

        //edit user
        if (filter_input(INPUT_GET, 'action') === 'edit' && !db_update_user($db)) {
            $user = db_load_user($db);
            if (is_array($user) && !empty($user)) {
                echo '<h2>Edit User</h2>';
                echo '<p><a href="index.php" title="back to table">&#10096;</a></p>';
                html_user_form($user, 'edit', ['surname', 'email'], ['password']);
                $action = '';
            } else {
                echo '<p class="alert">User not found.</p>';
            }
        }

        //new user
        if (filter_input(INPUT_GET, 'action') === 'new' && !db_insert_user($db)) {
            echo '<h2>New User</h2>';
            echo '<p><a href="index.php" title="back to table">&#10096;</a></p>';
            $user = [
                'name' => strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)),
                'surname' => strval(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING)),
                'email' => filter_input(INPUT_POST, 'email') ? strval(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) : "@",
                'birthdate' => filter_input(INPUT_POST, 'birthdate') ? strval(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING)) : ""
            ];
            html_user_form($user, 'new', ['surname', 'email', 'password', 'birthday']);
            $action = '';
        }

        //show users in table
        if ($action === 'show') {
            echo '<h2>Users</h2>';
            echo '<p><a href="index.php?action=new" title="Create new user">&#10010;</a></p>';
            html_users_table($db);
        }

        mysqli_close($db); //close conection to MySQL
        ?>
    </main>
</body>

</html>