<?php

/**
 * Page controller
 * Determines according to POST and GET data what operation, model and view will be processed.
 */
class PageController
{

    /**
     * Util for DB operation
     *
     * @var DB
     */
    private $db;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = new DB();
        $this->db->init(DB_HOST, DB_USER, DB_PASS, DB_DTBS);
    }

    /**
     * Static factory
     *
     * @return PageController
     */
    public static function create(): PageController
    {
        return new PageController();
    }

    /**
     * Main signpost function
     *
     * @return void
     */
    public function run()
    {
        switch (filter_input(INPUT_GET, 'action')) {
            case 'new':
                $this->new();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'del':
                $this->del();
                break;
            default:
                $this->show();
        }
    }

    /**
     * Create a new user
     *
     * @return void
     */
    private function new()
    {
        $message = '';
        $userSuccessfullyCreated = false;
        if (filter_input(INPUT_POST, 'action') == 'new') {
            $user = new UserModel();
            $user->setName(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
            $user->setSurname(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING));
            $user->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $user->setPassword(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
            $user->setBirthdate(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
            $userSuccessfullyCreated = $user->insert($this->db);
            $message = (string) $user->getMessage();
        }
        if (!$userSuccessfullyCreated) {
            $formTmplt = new Template('newUserForm', [
                'name' => strval(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)),
                'surname' => strval(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING)),
                'email' => filter_input(INPUT_POST, 'email') ? strval(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) : "@",
                'birthdate' => filter_input(INPUT_POST, 'birthdate') ? strval(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING)) : ""
            ]);
            echo Template::create('page', [
                'message' => $message,
                'content' => (string) $formTmplt
            ]);
        } else {
            $this->show($message);
        }
    }

    /**
     * Modifies an existing user
     *
     * @return void
     */
    private function edit()
    {
        if (filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        } else if (filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        } else {
            $id = null;
        }
        $user = new UserModel();
        if (!$id || !$user->load($this->db, $id)) {
            $this->show((string) new Message('User to edit not found.', Message::ALERT));
            return;
        }
        $userSuccessfullyEdited = false;
        $message = '';
        if (filter_input(INPUT_POST, 'action') == 'edit') {
            $user->setName(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
            $user->setSurname(filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING));
            $user->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $user->setPassword(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
            $user->setBirthdate(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
            $userSuccessfullyEdited = $user->update($this->db);
            $message = (string) $user->getMessage();
        }
        if (!$userSuccessfullyEdited) {
            $formTmplt = new Template('editUserForm', [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'email' => $user->getEmail(),
                'birthdate' => $user->getBirthdate()
            ]);
            echo Template::create('page', [
                'message' => $message,
                'content' => (string) $formTmplt
            ]);
        } else {
            $this->show($message);
        }
    }

    /**
     * Deletes an existing user
     *
     * @return void
     */
    private function del()
    {
        if (filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        } else if (filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        } else {
            $id = null;
        }
        $user = new UserModel();
        if (!$id || !$user->load($this->db, $id)) {
            $this->show((string) new Message('User to delete not found.', Message::ALERT));
            return;
        }
        $userSuccessfullyDeleted = false;
        $message = '';
        if (filter_input(INPUT_POST, 'action') == 'del') {
            $userSuccessfullyDeleted = $user->delete($this->db);
            $message = (string) $user->getMessage();
        }
        if (!$userSuccessfullyDeleted) {
            echo Template::create('page', [
                'message' => $message,
                'content' => (string) new Template('deleteUserForm', ['id' => $user->getId(), 'name' => $user->getSurname()])
            ]);
        } else {
            $this->show($message);
        }
    }

    /**
     * Shows all users in table
     *
     * @param string $message
     * @return void
     */
    private function show($message = '')
    {
        $users = new UsersModel();
        $users->load($this->db);
        if ($users->empty()) {
            return;
        }
        $tableRowString = '';
        $tableRowTmplt = new Template('userTableRow');
        foreach ($users->getUsers() as $user) {
            $tableRowTmplt->setData([
                'id' => $user->getId(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'birthdate' => date('j. n. Y', strtotime($user->getBirthdate())),
                'email' => $user->getEmail()
            ]);
            $tableRowString .= (string) $tableRowTmplt;
            $tableRowTmplt->clearData();
        }
        echo Template::create('page', [
            'message' => $message,
            'content' => (string) new Template('userTable', ['tableRows' => $tableRowString])
        ]);
    }
}
