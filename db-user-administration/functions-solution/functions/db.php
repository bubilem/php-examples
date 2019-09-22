<?php

/**
 * Create a connection to the database and set character set
 *
 * @param string $dbHost
 * @param string $dbUser
 * @param string $dbPassword
 * @param string $dbDatabase
 * @param string $charset
 * @return mysqli|false
 */
function db_init(string $dbHost, string $dbUser, string $dbPassword, string $dbDatabase, string $charset = 'UTF8')
{
    $db = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);
    if ($db == false) {
        die('Connection error: ' . mysql_error());
    }
    db_query($db, "SET CHARACTER SET $charset");
    return $db;
}

/**
 * Provide a query with a report of success or failure
 *
 * @param mysqli|false $db
 * @param string $query
 * @param string $successMessage
 * @return mysqli_result|bool
 */
function db_query($db, string $query, string $successMessage = "")
{
    $result = mysqli_query($db, $query);
    if ($result === false) {
        echo '<p class="alert">' . mysqli_error($db) . '</p>';
    } else if (!empty($successMessage)) {
        echo '<p class="success">' . $successMessage . '</p>';
    }
    return $result;
}

function db_load_user($db, $id = null)
{
    if (empty($id)) {
        if (filter_input(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        } else if (filter_input(INPUT_GET, 'id')) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
    }
    if (intval($id) > 0 && $result = db_query($db, "SELECT * FROM user WHERE id = $id")) {
        return mysqli_fetch_array($result);
    } else {
        return false;
    }
}

/**
 * Insert user to the database
 *
 * @param mysqli|false $db
 * @return boolean
 */
function db_insert_user($db): bool
{
    if (filter_input(INPUT_POST, 'action') != 'new') {
        return false;
    }
    $success = true;
    if (!filter_input(INPUT_POST, 'surname') || !filter_input(INPUT_POST, 'password')) {
        echo '<p class="alert">You must enter surname and password.</p>';
        $success = false;
    }
    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        echo '<p class="alert">Bad or no email.</p>';
        $success = false;
    }
    if ($success) {
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
        $success = (bool) db_query($db, $query, 'User was created.');
    }
    return $success;
}

/**
 * Edit user in the database
 *
 * @param mysqli|false $db
 * @return boolean
 */
function db_update_user($db): bool
{
    if (filter_input(INPUT_POST, 'action') != 'edit') {
        return false;
    }
    $success = true;
    if (filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    } else {
        echo '<p class="alert">User identification not found.</p>';
        $success = false;
    }
    if (!filter_input(INPUT_POST, 'surname')) {
        echo '<p class="alert">You must enter surname.</p>';
        $success = false;
    }
    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        echo '<p class="alert">Bad or no email.</p>';
        $success = false;
    }
    if ($success) {
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
        $success = (bool) db_query($db, $query, 'User was modified.');
    }
    return $success;
}

/**
 * Delete user from the database
 *
 * @param mysqli|false $db
 * @return boolean
 */
function db_delete_user($db): bool
{
    if (!filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
        echo '<p class="alert">User identification not found.</p>';
        return false;
    }
    $user = db_load_user($db, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    if (!is_array($user) || empty($user)) {
        echo '<p class="alert">User not found.</p>';
        return false;
    }
    return (bool) db_query($db, "DELETE FROM user WHERE id = " . $user['id'], 'User was deleted.');
}
