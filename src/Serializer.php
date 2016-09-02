<?php

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file.
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright (c) 2016, Achmad F. Ibrahim
 * @link https://github.com/acfatah/serializable-closure
 * @license http://opensource.org/licenses/mit-license.php The MIT License (MIT)
 */

namespace Acfatah\SerializableClosure;

use Closure;
use Acfatah\SerializableClosure\SerializableClosure;

/**
 * Serializer class.
 *
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class Serializer
{
    /**
     * Serializes a data.
     *
     * @param mixed $data
     * @return string
     */
    public static function serialize($data)
    {
        if ($data instanceof Closure) {
            $data = new SerializableClosure($data);
        }

        return serialize($data);
    }

    /**
     * Unserializes a data.
     *
     * @param string $data
     * @return mixed
     */
    public static function unserialize($data)
    {
        return unserialize($data);
    }
}