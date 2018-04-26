<?php

namespace App\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;


/**
 * RefreshToken
 */
class RefreshToken extends BaseRefreshToken
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
