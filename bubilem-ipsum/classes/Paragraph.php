<?php
class Paragraph
{
    private $data;

    public function __construct($sentenceCount)
    {
        for ($i = 1; $i <= $sentenceCount; $i++) {
            $this->data .= (' ' . (string) new Sentence());
        }
    }

    public function __toString()
    {
        return '<p>' . trim($this->data) . '</p>';
    }
}
