<?php
namespace BlogBundle\Service;

Class BlogService
{
    static $sum;

    /**
     * @return mixed
     */
    public static function getSum()
    {
        return self::$sum;
    }

    /**
     * @param mixed $sum
     */
    public static function setSum($sum)
    {
        self::$sum = $sum;
    }

    public static function sum($num1, $num2)
    {
        self::setSum($num1 + $num2);
    }
}