<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/6/18
 * Time: 9:21 PM
 */

namespace Cottect\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Username extends Constraint
{
    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
