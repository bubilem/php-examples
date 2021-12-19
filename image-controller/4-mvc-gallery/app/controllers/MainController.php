<?php

abstract class MainController
{

    private $urlParams;

    public function __construct()
    {
        $this->urlParams = explode("/", trim(str_replace(
            URL_DIR,
            '',
            filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL)
        ), "/"));
        if (empty($this->urlParams)) {
            $this->urlParams = ['home'];
        }
    }

    public function getUrlParam(int $index): string
    {
        if (isset($this->urlParams[$index])) {
            return $this->urlParams[$index];
        } else {
            return '';
        }
    }

    public function redirect(string $uri)
    {
        header("Location: " . (strpos($uri, 'http') === 0 ? '' : URL . URL_DIR) . $uri);
        header("Connection: close");
        exit;
    }

    public abstract function run(): void;
}
