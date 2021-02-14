<?php
class Math
{
    /**
     * Factorial of n
     * 5! = 1*2*3*4*5
     * 5! = n!*5
     * 4! = 1*2*3*4
     * 3! = 1*2*3
     * @param int $n
     * @return int|null
     */
    public static function fact(int $n)
    {
        if ($n < 1) {
            return null;
        }
        $fact = 1;
        for ($i = 2; $i <= $n; $i++) {
            $fact *= $i;
        }
        return $fact;
    }

    /**
     * Primorial of n (all primes to the n)
     * prim(5) = 2*3*5
     * prim(11) = 2*3*5*7*11
     *
     * @param int $n
     * @return int|null
     */
    public static function primByLimit(int $n)
    {
        if ($n < 2) {
            return null;
        }
        $prim = 1;
        for ($i = 2; $i <= $n; $i++) {
            if (self::isPrime($i)) {
                $prim *= $i;
            }
        }
        return $prim;
    }

    /**
     * Primorial of n (first n primes)
     * prim(1) = 2
     * prim(2) = 2*3
     * prim(3) = 2*3*5
     * prim(4) = 2*3*5*7
     *
     * @param int $n
     * @return int
     */
    public static function primByCount(int $n)
    {
        if ($n < 1) {
            return null;
        }
        $prim = 1;
        $i = 1;
        $primes = 0;
        do {
            if (self::isPrime(++$i)) {
                $prim *= $i;
                $primes++;
            }
        } while ($primes < $n);
        return $prim;
    }

    /**
     * Checks if input number is a prime
     *
     * @param int $n
     * @return bool
     */
    public static function isPrime(int $n): bool
    {
        if ($n < 2) {
            return false;
        } else if ($n == 2) {
            return true;
        } else {
            for ($i = 2; $i <= (int)sqrt($n); $i++) {
                if ($n % $i == 0) {
                    return false;
                }
            }
        }
        return true;
    }

    public static function int2Str($n)
    {
        return is_int($n) ? number_format($n, 0, '.', ' ') : '-';
    }
}
