<?php
class Word
{
    private static $partOfSpeech = [
        1 => "Substantiva",
        2 => "Adjektiva",
        3 => "Pronomina",
        4 => "Numeralia",
        5 => "Verba",
        6 => "Adverbia",
        7 => "Prepozice",
        8 => "Konjunkce",
        9 => "Partikule",
        10 => "Interjekce"
    ];

    private static $number = ['singular', 'plural'];
    private static $gender = ['masculine', 'feminine', 'neuter'];
    private static $time = ['past', 'present', 'future'];
    private static $comma = ['nocomma', 'comma'];

    private static $dictionary = [];

    private $data;

    public function __construct($partOfSpeech, $number = null, $gender = null, $time = null, $comma = null)
    {
        switch ($partOfSpeech) {
            case 1:
            case 2:
            case 3:
            case 4:
                $words = self::$dictionary[$partOfSpeech][$number ? $number : self::randNumber()][$gender ? $gender : self::randGender()];
                $this->data = $words[mt_rand(0, count($words) - 1)];
                break;
            case 5:
                $time = $time ? $time : self::randTime();
                if ($number == 'infinitive') {
                    $words = self::$dictionary[5]['infinitive'];
                    $this->data = $words[mt_rand(0, count($words) - 1)];
                } else {
                    if ($time == 'past' || $time == 'perfect') {
                        $words = self::$dictionary[5][$number ? $number : self::randNumber()][$time][$gender ? $gender : self::randGender()];
                        $this->data = $words[mt_rand(0, count($words) - 1)];
                    } else {
                        $words = self::$dictionary[5][$number ? $number : self::randNumber()][$time];
                        $this->data = $words[mt_rand(0, count($words) - 1)];
                    }
                }
                if (mt_rand(1, 4) > 3) {
                    if (substr($this->data, 0, 3) === 'se ') {
                        $tmp = explode(" ", $this->data, 2);
                        $this->data = $tmp[0] . " ne" . $tmp[1];
                    } else {
                        $this->data = "ne" . $this->data;
                    }
                }
                break;
            case 6:
                $words = self::$dictionary[6];
                $this->data = $words[mt_rand(0, count($words) - 1)];
                break;
            case 8:
                $comma = $comma ? $comma : self::randComma();
                $words = self::$dictionary[8][$comma];
                $this->data = ($comma == 'comma' ? ', ' : ' ') . $words[mt_rand(0, count($words) - 1)];
                break;
            default:
                $this->data = '';
                break;
        }
    }

    public static function randNumber()
    {
        $key = array_rand(self::$number);
        return self::$number[$key];
    }

    public static function randGender()
    {
        $key = array_rand(self::$gender);
        return self::$gender[$key];
    }

    public static function randTime()
    {
        $key = array_rand(self::$time);
        return self::$time[$key];
    }

    public static function randComma()
    {
        $key = array_rand(self::$comma);
        return self::$comma[$key];
    }

    public static function loadDictionary($file)
    {
        self::$dictionary = json_decode(file_get_contents("dictionaries/$file.json"), true);
    }

    public function __toString()
    {
        return $this->data;
    }
}
