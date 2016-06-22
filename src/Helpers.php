<?php

namespace PFinal\Blade;

class Helpers
{
    /**
     * Escape HTML entities in a string.
     *
     * @param  string $value
     * @return string
     */
    public static function e($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }


    /**
     * Get all of the given array except for a specified array of items.
     *
     * @param  array $array
     * @param  array|string $keys
     * @return array
     */
    public static function array_except($array, $keys)
    {
        foreach ((array)$keys as $key) {
            unset($array[$key]);
        }

        return $array;
    }

}