<?php

/**
 * User model
 */
class UserModel extends MainModel
{
    /**
     * List of attributes
     *
     * @var array
     */
    public static $attributes = ['id', 'name', 'surname', 'email', 'password', 'birthdate'];

    /**
     * Database table name
     *
     * @var string
     */
    public static $table = 'user';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Loads user values from database record
     *
     * @param IDB $connection
     * @param string|int $id
     * @return boolean
     */
    public function load(IDB $connection, $id): bool
    {
        if (intval($id) == 0 || !$result = $connection->query("SELECT * FROM " . self::$table . " WHERE id = " . $id)) {
            return false;
        }
        $data = mysqli_fetch_array($result);
        if (empty($data)) {
            return false;
        }
        foreach (self::$attributes as $attribute) {
            $method = 'set' . $attribute;
            $this->$method($data[$attribute]);
        }
        return $this->isLoaded();
    }

    /**
     * Inserts new user to database
     *
     * @param IDB $connection
     * @return boolean
     */
    public function insert(IDB $connection): bool
    {
        $qAttributes = "";
        $qValues = "";
        foreach (self::$attributes as $attribute) {
            if ($attribute == 'id') {
                continue;
            }
            if (isset($this->data[$attribute])) {
                $qAttributes .= ((!empty($qAttributes) ? ',' : '') . $attribute);
                $qValues .= ((!empty($qValues) ? ',' : '') . "'" . $this->data[$attribute] . "'");
            }
        }
        if ($connection->query("INSERT INTO " . self::$table . " ($qAttributes) VALUES ($qValues)")) {
            $this->message->add('User was created.', Message::SUCCESS);
            return true;
        } else {
            $this->message->add($connection->getLastError(), Message::ALERT);
            return false;
        }
    }

    /**
     * Edits a user in the database
     *
     * @param IDB $connection
     * @return boolean
     */
    public function update(IDB $connection): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }
        $qValues = "";
        foreach (self::$attributes as $attribute) {
            if ($attribute == 'id') {
                continue;
            }
            $methodName = 'get' . ucfirst($attribute);
            $qValues .= (($qValues ? ', ' : '') . $attribute . " = '" . $this->$methodName() . "'");
        }
        if ($connection->query("UPDATE " . self::$table . " SET $qValues WHERE id = " . $this->getId())) {
            $this->message->add('User was modified.', Message::SUCCESS);
            return true;
        } else {
            $this->message->add($connection->getLastError(), Message::ALERT);
            return false;
        }
    }

    /**
     * Deletes user in database
     *
     * @param IDB $connection
     * @return boolean
     */
    public function delete(IDB $connection): bool
    {
        if ($this->isLoaded()) {
            if ($connection->query("DELETE FROM " . self::$table . " WHERE id = " . $this->getId())) {
                $this->message->add('User was deleted.', Message::SUCCESS);
                return true;
            } else {
                $this->message->add($connection->getLastError(), Message::ALERT);
                return false;
            }
        } else {
            $this->message->add("Not loaded user can't be deleted.", Message::ALERT);
            return false;
        }
    }

    /**
     * Checks if user data is loaded
     *
     * @return boolean
     */
    public function isLoaded(): bool
    {
        return $this->getId() && $this->getSurname() && $this->getEmail();
    }

    /**
     * Magic method for seters and geters
     *
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public function __call($name, $arguments)
    {
        if (strlen($name) < 4) {
            return;
        }
        $operation = substr($name, 0, 3);
        $attribute = strtolower(substr($name, 3));
        if (!in_array($attribute, self::$attributes)) {
            return;
        }
        switch ($operation) {
            case 'get':
                return isset($this->data[$attribute]) ? $this->data[$attribute] : null;
            case 'set':
                $value = filter_var(implode(', ', $arguments), ($attribute == 'email' ? FILTER_SANITIZE_EMAIL : FILTER_SANITIZE_STRING));
                $this->data[$attribute] = ($attribute == 'password' ? hash('sha256', $value) : $value);
                return $this;
            case 'clear':
                $this->data[$attribute] = null;
                return $this;
        }
    }
}
