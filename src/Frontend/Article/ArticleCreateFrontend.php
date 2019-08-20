<?php

namespace Cottect\Frontend\Article;

use Cottect\Utils\Template;
use Cottect\Utils\RoutePath;
use Cottect\Utils\RouteName;
use Cottect\Frontend\AuthenticationFrontend;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Cottect\Form\Frontend\Article\ArticleCreateFrontendForm;
use Cottect\Http\Request\Frontend\Article\ArticleCreateFrontendRequest;

class ArticleCreateFrontend extends AuthenticationFrontend
{
    /**
     * @Route(RoutePath::FRONTEND_ARTICLE_CREATE, name=RouteName::FRONTEND_ARTICLE_CREATE)
     *
     * @param Request $request
     * @param ArticleCreateFrontendRequest $articleCreateRequest
     * @return Response
     */
    public function index(Request $request, ArticleCreateFrontendRequest $articleCreateRequest)
    {
        $form = $this->createForm(ArticleCreateFrontendForm::class, $articleCreateRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            dd($request->request->all());
        }
        return $this->render(
            Template::FRONTEND_ARTICLE_CREATE,
            [
                'form' => $form->createView(),
                'controller_name' => 'ArticleCreateFrontend',
            ]
        );
    }
}
