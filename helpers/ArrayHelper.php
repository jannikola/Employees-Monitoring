<?php

namespace app\helpers;


class ArrayHelper extends \yii\helpers\ArrayHelper
{

    public static function mapWithCountForSameKeys($array, $from, $to)
    {
        $results = [];
        foreach ($array as $element) {
            $key = static::getValue($element, $from);
            $value = static::getValue($element, $to);

            if (array_key_exists($key, $results)) {
                $results[$key] = $value + $results[$key];
                continue;
            }

            $results[$key] = $value;
        }

        return $results;
    }

    public static function addPrefixToKeys($array, $prefix, $prefixSeparator = '_')
    {
        $results = [];
        foreach ($array as $key => $item) {
            $prefixedKey = $prefix . $prefixSeparator . $key;
            $results[$prefixedKey] = $item;
        }

        return $results;
    }

    public static function removeValues(array $array, array $values)
    {
        foreach ($values as $value) {
            static::removeValue($array, $value);
        }

        return $array;
    }

    public static function sumColumn($column, array $array = [])
    {
        $sum = 0;

        foreach ($array as $item) {
            $sum += static::getValue($item, $column);
        }

        return $sum;
    }

    public static function existsIn(array $array, $value, $key = 'id')
    {
        foreach ($array as $item) {
            if ($value == static::getValue($item, $key)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $array the array to remove value from
     * @param string|array|integer $value value to remove from array
     * @return array the array without specified value
     */
    public static function removeIfValueExists($array, $value)
    {
        $value = is_array($value)? $value : [$value];

        return array_diff($array, $value);
    }

    /**
     * @param array $array the array to remove value from
     * @param string|array|integer $key key to remove from array
     * @return array the array without specified value
     * @internal param array|int|string $value value to remove from array
     */
    public static function removeIfKeyExists($array, $key)
    {
        if (array_key_exists($key, $array)) {
            unset($array[$key]);
        }

        return $array;
    }

    /**
     * @param array $array the array to be counted
     * @return int Number of elements in array
     */
    public static function countRecursive($array)
    {
        if (!is_array($array)) {
            return 1;
        }

        $count = 0;
        foreach($array as $sub_array) {
            $count += static::countRecursive($sub_array);
        }

        return $count;
    }
}