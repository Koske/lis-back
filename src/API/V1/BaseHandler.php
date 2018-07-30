<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.2.18.
 * Time: 17.29
 */

namespace App\API\V1;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseHandler
{
    protected $em;
    protected $container;
    protected $serializer;
    protected $user;
    protected $logger;
    protected $request;
    protected $params;

    function __construct(EntityManagerInterface $em, ContainerInterface $container, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->container = $container;
        $this->logger = $logger;
        $this->serializer = $container->get('jms_serializer');
    }

    protected function createResponse($statusCode = Response::HTTP_OK)
    {
        $response = new JsonResponse();
        $response->setStatusCode($statusCode);
        $response->headers->set('Access-Control-Allow-Origin', $this->container->getParameter('allowed_origins'));
        return $response;
    }

    protected function getResponse(array $result = [], $statusCode = Response::HTTP_OK)
    {
        $response = $this->createResponse($statusCode);

        $json = $this->serializer->serialize($result, 'json');
        $response->setData(json_decode($json, true));

        return $response;
    }

    public function getParams(Request $request)
    {
        $params = array();
        $content = $request->getContent();
        if(!empty($content))
        {
            $params = json_decode($content);
        }

        return $params;
    }

    public function getParameterMissingResponse()
    {
        return $this->getResponse([
            'status' => 'error',
            'message' => 'parametersMissing'
        ], Response::HTTP_BAD_REQUEST);
    }

    public function getSuccessResponse() {
        return $this->getResponse([
            'status' => 'ok',
            'message' => 'success'
        ], Response::HTTP_OK);
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getUser()
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }

}