<?php

namespace Cottect\Form\Frontend\User;

use Cottect\Http\Request\Frontend\User\UserLoginFrontendRequest;
use Cottect\Utils\RouteName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

class UserLoginFrontendForm extends AbstractType
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
                UserLoginFrontendRequest::USERNAME_FIELD,
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => self::LABEL_TRANSLATOR_ID . UserLoginFrontendRequest::USERNAME_FIELD,
                    ],
                ]
            )
            ->add(
                UserLoginFrontendRequest::PASSWORD_FIELD,
                PasswordType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => self::LABEL_TRANSLATOR_ID . UserLoginFrontendRequest::PASSWORD_FIELD,
                    ],
                ]
            )
            ->setMethod(Request::METHOD_POST)
            ->setAction($this->router->generate(RouteName::FRONTEND_USER_LOGIN));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UserLoginFrontendRequest::class
            ]
        );
    }
}
