<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/6/18
 * Time: 9:23 PM
 */

namespace Cottect\Validator\Constraints;

use Cottect\Services\User\UserCheckExistService;
use Cottect\Utils\Detect;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UsernameValidator extends ConstraintValidator
{
    protected $username;
    protected $detect;
    protected $translator;
    protected $checkUserExistService;

    public function __construct(
        UserCheckExistService $checkUserExistService,
        TranslatorInterface $translator,
        Username $username,
        Detect $detect
    ) {
        $this->username = $username;
        $this->detect = $detect;
        $this->translator = $translator;
        $this->checkUserExistService = $checkUserExistService;
    }

    public function validate($value, Constraint $constraint)
    {
        $this->detect->setData($value);
        if (!$this->detect->isPhone() && !$this->detect->isEmail()) {
            $this->context
                ->buildViolation($this->translator->trans('user.register.invalid_username'))
                ->addViolation();
        }
    }
}
