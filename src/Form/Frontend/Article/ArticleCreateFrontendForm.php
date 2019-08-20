<?php


namespace Cottect\Form\Frontend\Article;


use Cottect\Utils\RouteName;
use Cottect\Form\Frontend\BaseFormFrontend;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleCreateFrontendForm extends BaseFormFrontend
{
    const LABEL_TRANSLATOR_ID = 'label.';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod(Request::METHOD_POST)
            ->setAction($this->router->generate(RouteName::FRONTEND_ARTICLE_CREATE));
    }
}
