<?php

/**
 * Shows Yes/No form
 *
 * @param string $message
 * @param array $yesHidden
 * @param array $noHidden
 * @return void
 */
function html_yes_no_form(string $message, array $yesHidden = [], array $noHidden = [])
{
    echo "<h3>$message</h3>";
    echo '<form action="index.php" method="POST">';
    echo '<div>';
    echo '<input type="submit" name="submit" value="No">';
    foreach ($noHidden as $key => $val) {
        echo '<input type="hidden" name="' . $key . '" value="' . $val . '">';
    }
    echo '</div>';
    echo '</form>';
    echo '<form action="index.php" method="POST">';
    echo '<div>';
    echo '<input type="submit" name="submit" value="Yes">';
    foreach ($yesHidden as $key => $val) {
        echo '<input type="hidden" name="' . $key . '" value="' . $val . '">';
    }
    echo '</div>';
    echo '</form>';
}

/**
 * Shows a HTML form for the user
 *
 * @param array $userValues
 * @param string $action
 * @param array $required
 * @return void
 */
function html_user_form(array $userValues, string $action = 'new', array $required = [], array $ignoreValue = [])
{
    $userAttributes = [
        'name' => ['label' => 'Name', 'type' => 'text', 'maxlength' => "40"],
        'surname' => ['label' => 'Surname', 'type' => 'text',  'maxlength' => "40"],
        'email' => ['label' => 'Email', 'type' => 'email',  'maxlength' => "255"],
        'password' => ['label' => 'Password',  'type' => 'password', 'maxlength' => "20"],
        'birthdate' => ['label' => 'Birthdate', 'type' => 'date'],
    ];
    echo '<form action="index.php' . ($action ? '?action=' . $action : '') . '" method="POST">';
    foreach ($userAttributes as $key => $val) {
        echo '<div>';
        echo '<label for="' . $key . '">' . $val['label'] . '</label>';
        echo '<input type="' . $val['type'] . '" name="' . $key . '" id="' . $key . '"';
        if (!empty($val['maxlength'])) {
            echo ' maxlength="' . $val['maxlength'] . '"';
        }
        if (!empty($userValues[$key]) && !in_array($key, $ignoreValue)) {
            echo ' value="' . $userValues[$key] . '"';
        }
        if (in_array($key, $required)) {
            echo ' required';
        }
        echo '>';
        echo '</div>';
    }
    echo '<div>';
    if (!empty($userValues['id']) && $action == 'edit') {
        echo '<input type="submit" name="submit" value="Save">';
        echo '<input type="hidden" name="action" value="edit">';
        echo '<input type="hidden" name="id" value="' . $userValues['id'] . '">';
    } else if ($action == 'new') {
        echo '<input type="submit" name="submit" value="Create">';
        echo '<input type="hidden" name="action" value="new">';
    }
    echo '</div>';
    echo '</form>';
}

/**
 * Shows users from database to HTML table
 *
 * @param mysqli|false $db
 * @return void
 */
function html_users_table($db)
{
    $result = db_query($db, "SELECT * FROM user ORDER BY surname, name");
    if (!empty($result)) {
        echo '<div class="table"><table><tr><th>name</th><th>surname</th><th>birthdate</th><th>email</th><th></th></tr>';
        while ($user = mysqli_fetch_array($result)) {
            echo '<tr class="item">';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['surname'] . '</td>';
            echo '<td>' . date('j. n. Y', strtotime($user['birthdate'])) . '</td>';
            echo '<td><a href="mailto:' . $user['email'] . '">' . $user['email'] . '</a></td>';
            echo '<td>';
            echo '<a href="index.php?action=edit&id=' . $user['id'] . '" title="edit: ' . $user['surname'] . '">&#9998;</a>';
            echo ' ';
            echo '<a href="index.php?action=del&id=' . $user['id'] . '" title="delete: ' . $user['surname'] . '">&#10006;</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table></div>';
    }
}
