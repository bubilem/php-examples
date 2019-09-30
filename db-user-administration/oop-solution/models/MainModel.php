<?php

/**
 * Main abstract model
 * Allows the child class to work with data and messages
 */
abstract class MainModel
{
    /**
     * Message container
     *
     * @var Message
     */
    protected $message;

    /**
     * Model data container
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->message = new Message();
        $this->data = [];
    }

    /**
     * Message container geter
     *
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }
}
