<?php

namespace Cottect\Form\Frontend\User;

use Cottect\Entity\User;
use Cottect\Frontend\User\UserRegisterFrontend;
use Cottect\Http\Request\Frontend\User\UserRegisterFrontendRequest;
use Cottect\Utils\Date;
use Cottect\Utils\RouteName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

class UserRegisterFrontendForm extends AbstractType
{
    const LABEL_TRANSLATOR_ID = 'label.';

    protected $router;
    protected $translator;

    public function __construct(RouterInterface $router, TranslatorInterface $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                UserRegisterFrontendRequest::FIRST_NAME_FIELD,
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => self::LABEL_TRANSLATOR_ID . UserRegisterFrontendRequest::FIRST_NAME_FIELD,
                    ],
                ]
            )
            ->add(
                UserRegisterFrontendRequest::LAST_NAME_FIELD,
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => self::LABEL_TRANSLATOR_ID . UserRegisterFrontendRequest::LAST_NAME_FIELD,
                    ],
                ]
            )
            ->add(
                UserRegisterFrontendRequest::USERNAME_FIELD,
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => self::LABEL_TRANSLATOR_ID . UserRegisterFrontendRequest::USERNAME_FIELD,
                    ],
                ]
            )
            ->add(
                UserRegisterFrontendRequest::BIRTHDAY_FIELD,
                BirthdayType::class,
                [
                    'placeholder' => [
                        'year' => self::LABEL_TRANSLATOR_ID . 'year',
                        'month' => self::LABEL_TRANSLATOR_ID . 'month',
                        'day' => self::LABEL_TRANSLATOR_ID . 'day',
                    ],
                    'label_format' => self::LABEL_TRANSLATOR_ID . "%name%",
                    'format' => 'yyyyMMdd',
                    'years' => Date::yearChoiceOverTwelveYear()
                ]
            )
            ->add(
                UserRegisterFrontendRequest::PASSWORD_FIELD,
                PasswordType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => self::LABEL_TRANSLATOR_ID . UserRegisterFrontendRequest::PASSWORD_FIELD,
                    ],
                ]
            )
            ->add(
                UserRegisterFrontendRequest::GENDER_FIELD,
                ChoiceType::class,
                [
                    'choices' => [
                        self::LABEL_TRANSLATOR_ID . 'male' => User::MALE,
                        self::LABEL_TRANSLATOR_ID . 'female' => User::FEMALE,
                    ],
                    'expanded' => true,
                    'multiple' => false,
                    'label' => false,
                    'attr' => [
                        'class' => 'form-check-inline',
                    ],
                ]
            )
            ->setMethod(Request::METHOD_POST)
            ->setAction($this->router->generate(RouteName::FRONTEND_USER_REGISTER));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UserRegisterFrontendRequest::class
            ]
        );
    }
}
