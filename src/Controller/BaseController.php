<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.2.18.
 * Time: 20.40
 */

namespace App\Controller;

use App\Entity\AccessToken;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends  FOSRestController
{
    protected function getApiUser(Request $request, $storage)
    {
        if (!$request->headers->has('Authorization')) {
            return null;
        }

        $tokenString = $request->headers->get('Authorization');

        $tokenString = explode(' ', $tokenString)[1];

        $token = $this->getDoctrine()->getManager()->getRepository(AccessToken::class)->findOneBy(array('token' => $tokenString));

        if ($token == null || $token->hasExpired()) {
            return null;
        }

        $storage->setToken($token);

        return $token->getUser();
    }

    protected function getSerializer()
    {
        return $this->get('jms_serializer');
    }

    protected function getHandler(Request $request, $type)
    {
        $handler = $this->get('app.api.factory')->getHandler($request, $type);
        $handler->setRequest($request);
        return $handler;
    }

}