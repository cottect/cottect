<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/20/18
 * Time: 5:40 PM
 */

namespace Cottect\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UsernameRegisterValidator extends UsernameValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        parent::validate($value, $constraint);
        if ($this->detect->isPhone() && $this->checkUserExistService->byPhone($value)) {
            $this->context
                ->buildViolation($this->translator->trans('user.register.phone_number_already_exist'))
                ->addViolation();
        }
        if ($this->detect->isEmail() && $this->checkUserExistService->byEmail($value)) {
            $this->context
                ->buildViolation($this->translator->trans('user.register.email_already_exist'))
                ->addViolation();
        }
    }
}
