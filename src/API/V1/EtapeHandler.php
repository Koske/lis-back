<?php

namespace App\API\V1;

use App\Entity\Etape;
use App\Entity\Project;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EtapeHandler extends BaseHandler
{
    public function newEtapeProjects(Request $request){
        $params = $this->getParams($request);

        if (!$params->projectId || !$params->name || !$params->description || !$params->dateStarted || !$params->dateEnded) {


            return $this->getParameterMissingResponse();
        }

        $this->container->get('app.etape')->createEtape($params->projectId ,$params->name, $params->description, $params->dateStarted, $params->dateEnded);

        return $this->getSuccessResponse();
    }

    public function getEtapes(){
        $etapes =  $this->container->get('app.etape')->getAll();

        return $this->getResponse($etapes);
    }

}