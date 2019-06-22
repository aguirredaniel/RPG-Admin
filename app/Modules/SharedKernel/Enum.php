<?php

namespace App\Modules\SharedKernel;

use ReflectionClass;

/**
 * Enum
 * Simple abstraction to Enum concept.
 *
 */
abstract class Enum
{
    /**
     * Default value if constant doesn't exists in a enum.
     */


    /**
     * Query function for keys in enum.
     *
     * @return array for key in Enum.
     * @throws \ReflectionException
     */

    static function getKeys()
    {
        $class = new ReflectionClass(get_called_class());
        return array_keys($class->getConstants());
    }

    /**
     * Query function for values in enum.
     *
     * @return array for vales in Enum.
     * @throws \ReflectionException
     */

    static function getValues()
    {
        $class = new ReflectionClass(get_called_class());
        return array_values($class->getConstants());
    }

    /**
     * Query function for values in enum.
     *
     * @return int that matches in enum values, if not in values return NotExists.
     * @throws \ReflectionException
     */

    static function getByValue($val)
    {
        return in_array($val, self::getValues()) ? $val : -9999;
    }
}
