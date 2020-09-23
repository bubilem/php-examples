<?php

/**
 * IPv4 Address
 * 
 * @version 0.0.1 120212
 * @license MIT
 * @todo Uf, uf, too much to do.
 * @author Michal Bubílek <michal.bubilek@skolavdf.cz>
 */
class AddressIPv4
{
    /**
     * Address value
     *
     * @var string binary representation
     */
    private $address;

    /**
     * Constructor
     *
     * @param string $address binary or decimal representation
     */
    public function __construct(string $address = "")
    {
        $this->set($address);
    }


    public function set(string $address): bool
    {
        if (self::isDecimal($address)) {
            $this->address = self::toBinary($address);
            return true;
        } else if (self::isBinary($address)) {
            $this->address = $address;
            return true;
        }
        return false;
    }

    public function getBinary(): string
    {
        return $this->address;
    }

    public function getDecimal(): string
    {
        return self::toDecimal($this->address);
    }

    public function isValid(): bool
    {
        return self::isBinary($this->address);
    }

    public function getNextAddress(int $shift = 1)
    {
        $next = str_pad(decbin(bindec($this->getBinary()) + $shift), 32, '0', STR_PAD_LEFT);
        return new AddressIPv4($next);
    }

    public function renderDecimal(int $prefix = 32): string
    {
        $str = '';
        if (self::isValid($this->address)) {
            $class = $prefix > 0 ? "network" : "";
            foreach (explode(".", trim($this->getDecimal())) as $key => $octet) {
                $str .= ($key > 0 ? '.' : '');
                if ($prefix && $key * 8 + 8 > $prefix) {
                    $class = "mixed";
                }
                if ($prefix && $key * 8 >= $prefix) {
                    $class = "host";
                }
                $octet = str_pad($octet, 3, '0', STR_PAD_LEFT);
                $str .= ('<span class="' . $class . '">' . $octet . '</span>');
            }
        }
        return  '<span class="decimal">' . $str . '</span>';
    }

    public function renderBinary(int $prefix = 32, int $parentPrefix = 0): string
    {
        $str = '';
        $class = 'network';
        if (self::isValid($this->address)) {
            $binary = $this->getBinary();
            for ($i = 0; $i < 32; $i++) {
                $str .= ($i > 0 && $i % 8 == 0 ? '.' : '');
                if ($i == $parentPrefix && $parentPrefix && $parentPrefix < $prefix) {
                    $class = 'subnet';
                }
                if ($i == $prefix) {
                    $class = 'host';
                }
                $str .= ("<span class=" . $class . ">" . $binary[$i] . "</span>");
            }
        }
        return  '<span class="binary">' . $str . '</span>';
    }

    public function getBits($from = 1, $to = 32): string
    {
        if ($from > $to || $from < 1 || $from > 32 || $to < 1 || $to > 32) {
            return '';
        }
        return substr($this->address, $from - 1, $to - $from + 1);
    }


    public function setBits(string $bits, $startBit = 0)
    {
        $binary = $this->getBinary();
        for ($i = 0; $i < 32; $i++) {
            if ($i >= $startBit && $i < $startBit + strlen($bits) && in_array($bits[$i - $startBit], [0, 1])) {
                $binary[$i] = $bits[$i - $startBit];
            }
        }
        $this->set($binary);
    }

    public function setBit(string $bit, $from = 1, $to = 32)
    {
        if (!in_array($bit, [0, 1]) || $from > $to || $from < 1 || $from > 32 || $to < 1 || $to > 32) {
            return;
        }
        $binary = $this->getBinary();
        for ($i = $from - 1; $i < $to; $i++) {
            $binary[$i] = $bit;
        }
        $this->set($binary);
    }

    public static function toBinary(string $decimal): string
    {
        if (!self::isDecimal($decimal)) {
            return "";
        }
        $bin = "";
        foreach (explode(".", trim($decimal)) as $octet) {
            $bin .= str_pad(decbin($octet), 8, "0", STR_PAD_LEFT);
        }
        return $bin;
    }

    public static function toDecimal(string $binary): string
    {
        $binary = str_pad($binary, 32, "0", STR_PAD_LEFT);
        if (!self::isBinary($binary)) {
            return "";
        }
        $decimal = '';
        for ($i = 0; $i < 4; $i++) {
            $decimal .= (($i > 0 ? '.' : '') . bindec(substr($binary, $i * 8, 8)));
        }
        return $decimal;
    }

    public static function isDecimal(string $decimal): bool
    {
        $decimal = explode(".", $decimal);
        if (!is_array($decimal) || count($decimal) !== 4) {
            return false;
        }
        foreach ($decimal as $octet) {
            if ($octet != intval($octet) || intval($octet) < 0 || intval($octet) > 255) {
                return false;
            }
        }
        return true;
    }
    public static function isBinary(string $binary): bool
    {
        if (strlen($binary) !== 32) {
            return false;
        }
        for ($i = 0; $i < 32; $i++) {
            if (!in_array($binary[$i], ["0", "1"])) {
                return false;
            }
        }
        return true;
    }
}
