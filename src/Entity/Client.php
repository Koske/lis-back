<?php

namespace App\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

/**
 * Client
 */
class Client extends BaseClient
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $accessToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $refreshToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $authCode;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add accessToken
     *
     * @param \App\Entity\AccessToken $accessToken
     *
     * @return Client
     */
    public function addAccessToken(\App\Entity\AccessToken $accessToken)
    {
        $this->accessToken[] = $accessToken;

        return $this;
    }

    /**
     * Remove accessToken
     *
     * @param \App\Entity\AccessToken $accessToken
     */
    public function removeAccessToken(\App\Entity\AccessToken $accessToken)
    {
        $this->accessToken->removeElement($accessToken);
    }

    /**
     * Get accessToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Add refreshToken
     *
     * @param \App\Entity\RefreshToken $refreshToken
     *
     * @return Client
     */
    public function addRefreshToken(\App\Entity\RefreshToken $refreshToken)
    {
        $this->refreshToken[] = $refreshToken;

        return $this;
    }

    /**
     * Remove refreshToken
     *
     * @param \App\Entity\RefreshToken $refreshToken
     */
    public function removeRefreshToken(\App\Entity\RefreshToken $refreshToken)
    {
        $this->refreshToken->removeElement($refreshToken);
    }

    /**
     * Get refreshToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Add authCode
     *
     * @param \App\Entity\AuthCode $authCode
     *
     * @return Client
     */
    public function addAuthCode(\App\Entity\AuthCode $authCode)
    {
        $this->authCode[] = $authCode;

        return $this;
    }

    /**
     * Remove authCode
     *
     * @param \App\Entity\AuthCode $authCode
     */
    public function removeAuthCode(\App\Entity\AuthCode $authCode)
    {
        $this->authCode->removeElement($authCode);
    }

    /**
     * Get authCode
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }
}
