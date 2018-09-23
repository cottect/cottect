<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/18/18
 * Time: 10:51 PM
 */

namespace Cottect\Http;

use ReflectionObject;

abstract class Request
{


    /**
     * @param array $request
     */
    public function load($request)
    {
        $className = get_called_class();
        $reflection = new ReflectionObject(new $className);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            if (isset($request[$property->getName()])) {
                $this->{'set' . ucfirst($property->getName())}($request[$property->getName()]);
            }
        }
    }
}
