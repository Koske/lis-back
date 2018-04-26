<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use FOS\OAuthServerBundle\Model\ClientUserInterface;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

/**
 * AccessToken
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \App\Entity\Client
     */
    protected $client;

    /**
     * @var \App\Entity\User
     */
    protected $user;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}
