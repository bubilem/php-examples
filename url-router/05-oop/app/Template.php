<?php
class Template
{
    private $filename;
    private $data;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->data = [];
    }

    public function data(array $data): Template
    {
        $this->data = $data;
        return $this;
    }

    public function render(): string
    {
        if (!file_exists(TMPLT_DIR . $this->filename)) {
            return "";
        }
        $content = file_get_contents(TMPLT_DIR . $this->filename);
        foreach ($this->data as $key => $val) {
            $content = str_replace('{' . $key . '}', $val, $content);
        }
        return $content;
    }
}
