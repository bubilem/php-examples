<?php

/**
 * Message container
 */
class Message
{

    const ALERT = 'Alert';
    const SUCCESS = 'Success';

    /**
     * Array of messages
     *
     * @var array
     */
    private $messages;

    /**
     * Constructor
     * 
     * Allows direct insertion of one message
     * @param string $message
     * @param string $type
     */
    public function __construct(string $message = '', string $type = self::ALERT)
    {
        $this->messages = [];
        if (!empty($message)) {
            $this->add($message, $type);
        }
    }

    /**
     * Static factory
     *
     * @return Message
     */
    public static function create(): Message
    {
        return new Message();
    }

    /**
     * Add message to messages container
     *
     * @param string $message
     * @param string $type
     * @return Message
     */
    public function add(string $message, string $type = self::ALERT): Message
    {
        $this->messages[] = ['type' => $type, 'content' => $message];
        return $this;
    }

    /**
     * Generates html string from messages container
     *
     * @return string
     */
    public function render(): string
    {
        $str = '';
        foreach ($this->messages as $message) {
            $str .= (string) new Template('message' . $message['type'], ['content' => $message['content']]);
        }
        $this->messages = [];
        return $str;
    }

    /**
     * Transfer object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
