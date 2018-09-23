<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 10:37 AM
 */

namespace Cottect\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cottect\Repository\OauthRefreshTokenRepository")
 * @ORM\Table(name="cot_oauth_refresh_token")
 * @ORM\HasLifecycleCallbacks
 */
class OauthRefreshToken extends OauthToken
{

}
