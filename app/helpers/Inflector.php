<?php
/**
 * Created by PhpStorm.
 * User: bogwien
 * Date: 06.12.2017
 * Time: 16:22
 */

namespace app\helpers;

/**
 * Class Inflector
 * @package app\helpers
 */
class Inflector
{
    /**
     * Converts an ID into a CamelCase name.
     * Words in the ID separated by `$separator` (defaults to '-') will be concatenated into a CamelCase name.
     * For example, 'post-tag' is converted to 'PostTag'.
     * @param string $id the ID to be converted
     * @param string $separator the character used to separate the words in the ID
     * @return string the resulting CamelCase name
     */
    public static function idToCamelCase($id, $separator = '-')
    {
        return str_replace(' ', '', ucwords(implode(' ', explode($separator, $id))));
    }

    /**
     * Converts an ID into a CamelCase name.
     * Words in the ID separated by `$separator` (defaults to '-') will be concatenated into a CamelCase name.
     * For example, 'post-tag' is converted to 'PostTag'.
     * @param string $id the ID to be converted
     * @param string $separator the character used to separate the words in the ID
     * @return string the resulting CamelCase name
     */
    public static function idToLowerCamelCase($id, $separator = '-')
    {
        return lcfirst(self::idToCamelCase($id, $separator));
    }

    /**
     * Converts a CamelCase name into an ID in lowercase.
     * Words in the ID may be concatenated using the specified character (defaults to '-').
     * For example, 'PostTag' will be converted to 'post-tag'.
     * @param string $name the string to be converted
     * @param string $separator the character used to concatenate the words in the ID
     * @param bool|string $strict whether to insert a separator between two consecutive uppercase chars, defaults to false
     * @return string the resulting ID
     */
    public static function camelCaseToId($name, $separator = '-', $strict = false)
    {
        $regex = $strict ? '/[A-Z]/' : '/(?<![A-Z])[A-Z]/';
        if ($separator === '_') {
            return strtolower(trim(preg_replace($regex, '_\0', $name), '_'));
        }

        return strtolower(trim(str_replace('_', $separator, preg_replace($regex, $separator . '\0', $name)), $separator));

    }
}
