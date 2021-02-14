<?php
error_reporting(E_ALL);
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
    <style>
        body {
            color: #5d5a58;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(45deg, #2d7d9a 0%, #00b7c3 100%);
            background-size: 100vw 100vh;
            height: 100vh;
        }

        h1,
        h2,
        h3 {
            margin: 0;
            padding: 10px;
        }

        h1 {
            font-size: 1.6rem;
            text-transform: uppercase;
            border-bottom: #2d7d9a 2px solid;
        }

        h2 {
            font-size: 1.3rem;
        }

        h3 {
            font-size: 1.1rem;
        }

        p {
            margin: 0px;
            padding: 10px;
            font-size: 1rem;
        }

        p.alert {
            color: #ffffff;
            background: #d13438;
        }

        p.success {
            color: #ffffff;
            background: #10893e;
        }

        main {
            width: 100%;
            max-width: 620px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 5px;
        }

        .table {
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            border-bottom: 1px #2d7d9a solid;
            padding: 6px;
        }

        table th {
            text-align: left;
            font-size: 0.8rem;
            font-style: italic;
        }

        form>div {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: center;
            align-content: flex-start;
            padding: 10px;
        }

        form>div>label {
            color: #2d7d9a;
            text-align: left;
            padding-right: 1rem;
            width: 8rem;
        }

        form>div>input {
            width: 100%;
        }

        input {
            color: #5d5a58;
            border: none;
            border-bottom: #2d7d9a 1px solid;
            padding: 5px;
        }

        a,
        input[type="submit"] {
            font-size: 1rem;
            text-decoration: none;
            color: #fff;
            background: #2d7d9a;
            padding: 4px 8px;
            border: none;
            border-radius: 3px;
            transition: all 200ms linear;
        }

        a:hover,
        input[type="submit"]:hover {
            background: #5d5a58;
            cursor: pointer;
        }

        @media only screen and (min-width: 576px) {
            form>div {
                flex-wrap: nowrap;
            }

            form>div>label {
                text-align: right;
                padding-right: 1rem;
            }
        }
    </style>
</head>

<body>
    <main>
        <h1>User administration</h1>
        <?php
        $action = 'table';
        $db = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);
        if ($db == false) {
            die('Connection error: ' . mysql_error());
        }
        mysqli_query($db, 'SET CHARACTER SET UTF8');

        //User deleting from DB
        if (filter_input(INPUT_POST, 'action') === 'del') {
            $action = 'table';
            if (filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
                if (mysqli_query($db, "DELETE FROM user WHERE id = " . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT))) {
                    echo '<p class="success">User was deleted.</p>';
                } else {
                    echo '<p class="alert">' . mysqli_error($db) . '</p>';
                }
            } else {
                echo '<p class="alert">User identification not found.</p>';
            }
        }

        //delete user confirmation form
        if (filter_input(INPUT_GET, 'action') === 'del' && filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {
            $action = 'del';
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
        if ($action === 'del' && !empty($id)) {
            $user = mysqli_fetch_array(mysqli_query($db, "SELECT id, name, surname FROM user WHERE id = $id"));
            if ($user) {
        ?>
                <h2>Delete User</h2>
                <p><a href="index.php" title="back to table">&#10096;</a></p>
                <h3>Are you sure to delete user <?php echo $user['surname']; ?>?</h3>
                <form action="index.php" method="POST">
                    <div>
                        <input type="submit" name="submit" value="No">
                    </div>
                </form>
                <form action="index.php" method="POST">
                    <div>
                        <input type="submit" name="submit" value="Yes">
                        <input type="hidden" name="action" value="del">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    </div>
                </form>
            <?php
            } else {
                echo '<p class="alert">User not found.</p>';
            }
        }

        //User editing in DB
        if (filter_input(INPUT_POST, 'action') === 'edit') {
            $fail = false;
            $action = 'table';
            if (filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
                $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            } else {
                echo '<p class="alert">User identification not found.</p>';
                $fail = true;
            }
            if (!filter_input(INPUT_POST, 'surname')) {
                echo '<p class="alert">You must enter surname.</p>';
                $fail = true;
            }
            if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                echo '<p class="alert">Bad or no email.</p>';
                $fail = true;
            }
            if (!$fail) {
                $query = "UPDATE user SET";
                if (filter_input(INPUT_POST, 'name')) {
                    $query .= " name = '" . strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)) . "'";
                }
                $query .= ", surname = '" . strval(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING)) . "'";
                $query .= ", email = '" . strval(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) . "'";
                if (filter_input(INPUT_POST, 'password')) {
                    $query .= ", password = '" . hash('sha256', strval(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))) . "'";
                }
                if (filter_input(INPUT_POST, 'birthdate')) {
                    $query .= ", birthdate = '" . strval(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING)) . "'";
                }
                $query .= " WHERE id = $id";
                if (mysqli_query($db, $query)) {
                    echo '<p class="success">User was edited.</p>';
                } else {
                    echo '<p class="alert">' . mysqli_error($db) . '</p>';
                    $action = 'edit';
                }
            } else {
                $action = 'edit';
            }
        }

        //edit user form
        if (filter_input(INPUT_GET, 'action') === 'edit' && filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {
            $action = 'edit';
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
        if ($action === 'edit' && !empty($id)) {
            $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM user WHERE id = $id"));
            if ($user) {
            ?>
                <h2>Edit User</h2>
                <p><a href="index.php" title="back to table">&#10096;</a></p>
                <form action="index.php" method="POST">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" maxlength="40" value="<?php echo $user['name']; ?>">
                    </div>
                    <div>
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" id="surname" maxlength="40" value="<?php echo $user['surname']; ?>" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" maxlength="255" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" maxlength="20" value="">
                    </div>
                    <div>
                        <label for="birthdate">Birthdate</label>
                        <input type="date" name="birthdate" id="birthdate" value="<?php echo $user['birthdate']; ?>" required>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    </div>
                </form>
            <?php
            } else {
                echo '<p class="alert">User not found.</p>';
            }
        }

        //new user to DB
        if (filter_input(INPUT_POST, 'action') === 'new') {
            $fail = false;
            $action = 'table';
            if (!filter_input(INPUT_POST, 'surname') || !filter_input(INPUT_POST, 'password')) {
                echo '<p class="alert">You must enter surname and password.</p>';
                $fail = true;
            }
            if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                echo '<p class="alert">Bad or no email.</p>';
                $fail = true;
            }
            if (!$fail) {
                $query = "INSERT INTO user (name, surname, email, password, birthdate) VALUES (";
                if (filter_input(INPUT_POST, 'name')) {
                    $query .= "'" . strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)) . "'";
                } else {
                    $query .= "NULL";
                }
                $query .= ",'" . strval(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING)) . "'";
                $query .= ",'" . strval(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) . "'";
                $query .= ",'" . hash('sha256', strval(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))) . "'";
                if (filter_input(INPUT_POST, 'birthdate')) {
                    $query .= ",'" . strval(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING)) . "'";
                } else {
                    $query .= ", NULL";
                }
                $query .= ")";
                if (mysqli_query($db, $query)) {
                    echo '<p class="success">User was created.</p>';
                } else {
                    echo '<p class="alert">' . mysqli_error($db) . '</p>';
                    $action = 'new';
                }
            } else {
                $action = 'new';
            }
        }

        //new user form
        if (filter_input(INPUT_GET, 'action') === 'new' || $action === 'new') {
            $action = 'new';
            $name = strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
            $surname = strval(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING));
            $email = filter_input(INPUT_POST, 'email') ? strval(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) : "@";
            $birthdate = filter_input(INPUT_POST, 'birthdate') ? strval(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING)) : "";
            ?>
            <h2>New User</h2>
            <p><a href="index.php" title="back to table">&#10096;</a></p>
            <form action="index.php" method="POST">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" maxlength="40" value="<?php echo $name; ?>">
                </div>
                <div>
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" maxlength="40" value="<?php echo $surname; ?>" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" maxlength="255" value="<?php echo $email; ?>" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" maxlength="20" value="" required>
                </div>
                <div>
                    <label for="birthdate">Birthdate</label>
                    <input type="date" name="birthdate" id="birthdate" value="" required>
                </div>
                <div>
                    <input type="submit" name="submit" value="Create">
                    <input type="hidden" name="action" value="new">
                </div>
            </form>
        <?php
        }


        //users in table
        if ($action == 'table') {
            echo '<h2>Users</h2>';
            echo '<p><a href="index.php?action=new" title="create new user">&#10010;</a></p>';
            $result = mysqli_query($db, "SELECT * FROM user ORDER BY surname, name");
            if (!empty($result)) {
                echo '<div class="table"><table><tr><th>name</th><th>surname</th><th>birthdate</th><th>email</th><th></th></tr>';
                while ($item = mysqli_fetch_array($result)) {
                    echo '<tr class="item">';
                    echo '<td>' . $item['name'] . '</td>';
                    echo '<td>' . $item['surname'] . '</td>';
                    echo '<td>' . date('j. n. Y', strtotime($item['birthdate'])) . '</td>';
                    echo '<td><a href="mailto:' . $item['email'] . '">' . $item['email'] . '</a></td>';
                    echo '<td>';
                    echo '<a href="index.php?action=edit&id=' . $item['id'] . '" title="edit: ' . $item['surname'] . '">&#9998;</a>';
                    echo ' ';
                    echo '<a href="index.php?action=del&id=' . $item['id'] . '" title="delete: ' . $item['surname'] . '">&#10006;</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table></div>';
            }
        }

        mysqli_close($db); //close conection to MySQL
        ?>
    </main>
</body>

</html>