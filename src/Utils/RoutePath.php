<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 6/3/18
 * Time: 2:32 PM
 */

namespace Cottect\Utils;

class RoutePath
{
    const FRONTEND_HOME_INDEX = '/';

    const FRONTEND_USER_REGISTER = '/register';
    const FRONTEND_USER_LOGIN = '/login';
    const FRONTEND_USER_LOGOUT = '/logout';
    const FRONTEND_USER_CHECKPOINT = '/checkpoint';
    const FRONTEND_USER_FORGOTTEN_ACCOUNT = '/forgotten-account';

    const FRONTEND_DASHBOARD_INDEX = '/dashboard';

    const FRONTEND_PAGE_INDEX = '/page';
    const FRONTEND_PAGE_CREATE = '/page/create';

    const FRONTEND_ARTICLE_INDEX = '/article';
    const FRONTEND_ARTICLE_DETAIL = '/article/detail';
    const FRONTEND_ARTICLE_CREATE = '/article/create';

    const FRONTEND_PRODUCT_INDEX = '/product';

    const FRONTEND_CART_INDEX = '/cart';

    const FRONTEND_CHECKOUT_INDEX = '/checkout';

    const FRONTEND_CATEGORY_INDEX = '/category';

    const FRONTEND_MANAGE_INDEX = '/manage';
}
