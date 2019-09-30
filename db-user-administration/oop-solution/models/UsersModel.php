<?php

/**
 * List of users model
 */
class UsersModel extends MainModel
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Load users from database
     *
     * @param IDB $connection
     * @return boolean
     */
    public function load(IDB $connection): bool
    {
        if (!$result = $connection->query("SELECT * FROM " . UserModel::$table)) {
            return false;
        }
        $records = $connection->fetchAll($result);
        if (empty($records)) {
            return false;
        }
        foreach ($records as $record) {
            $user = new UserModel();
            foreach (UserModel::$attributes as $attribute) {
                if (isset($record[$attribute])) {
                    $method = 'set' . $attribute;
                    $user->$method($record[$attribute]);
                }
            }
            $this->data[] = $user;
        }
        return true;
    }

    /**
     * Array of users geter
     *
     * @return array
     */
    public function getUsers()
    {
        return $this->data;
    }

    /**
     * Checks if users are loaded
     *
     * @return void
     */
    public function empty()
    {
        return empty($this->data);
    }
}
