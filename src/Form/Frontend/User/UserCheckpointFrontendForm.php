<?php

namespace Cottect\Form\Frontend\User;

use Cottect\Http\Request\Frontend\User\UserCheckpointFrontendRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCheckpointFrontendForm extends AbstractType
{
    const LABEL_TRANSLATOR_ID = 'label.';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                UserCheckpointFrontendRequest::VERIFY_CODE_FIELD,
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => self::LABEL_TRANSLATOR_ID . UserCheckpointFrontendRequest::VERIFY_CODE_FIELD,
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UserCheckpointFrontendRequest::class
            ]
        );
    }
}
