<?php
class Sentence
{
    private static $patterns = [
        "20*3 50*1 100*5 20*6",
        "20*3 20*4 50*2 100*1 100*5 25*6 10*5-infinitive",
        "50*2 100*1 100*5 20*6 100*6 20*6 100*5-?-?-perfect",
        "80*6 20*3 20*40 50*2 80*1 100*5 25*6",
        "20*3 20*4 50*2 100*1 100*8-?-?-?-nocomma 20*3 100*1 20*6 100*5-plural-?-?-? 20*6 20*5-?-?-perfect"
    ];

    private $data = "";

    public function __construct()
    {
        $max = 4;
        $exit = false;
        do {
            $this->generateSentence();
            $exit = mt_rand(1, 2) > 1 || $max-- == 0 ? true : false;
            if (!$exit) {
                $this->data .= ((string) new Word(8));
            }
        } while (!$exit);
    }

    private function generateSentence()
    {
        $pattern = explode(' ', self::randPatern());
        $number = Word::randNumber();
        $gender = Word::randGender();
        $time = Word::randTime();
        $comma = null;
        //var_dump($number, $gender, $time);
        foreach ($pattern as $item) {
            $countAndWord = explode('*', $item);
            $word = explode('-', $countAndWord[1]);
            if ($countAndWord[0] >= mt_rand(1, 100)) {
                if (!empty($word[1]) && $word[1] != "?") {
                    $number = $word[1];
                }
                if (!empty($word[2]) && $word[2] != "?") {
                    $gender = $word[2];
                }
                if (!empty($word[3]) && $word[3] != "?") {
                    $time = $word[3];
                }
                if (!empty($word[4]) && $word[4] != "?") {
                    $comma = $word[4];
                }
                $this->data .= (' ' . new Word($word[0], $number, $gender, $time, $comma));
            }
        }
    }

    public static function randPatern()
    {
        $key = array_rand(self::$patterns);
        return self::$patterns[$key];
    }

    public static function ucfirst($string)
    {
        $strlen = mb_strlen($string, "UTF-8");
        $firstChar = mb_substr($string, 0, 1, "UTF-8");
        $then = mb_substr($string, 1, $strlen - 1, "UTF-8");
        return mb_strtoupper($firstChar, "UTF-8") . $then;
    }

    public function __toString()
    {
        return (self::ucfirst(trim(preg_replace('!\s+!', ' ', $this->data))) . ".");
    }
}
