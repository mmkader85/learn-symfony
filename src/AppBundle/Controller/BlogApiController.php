<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogApiController
 * @package AppBundle\Controller
 * Chapter 6 - Controller 6
 */
class BlogApiController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     * @Route("/blog/post/{id}")
     * @Method({"GET", "HEAD"})
     */
    public function showAction($id)
    {

        return new JsonResponse(array(
            'id' => $id,
            'blogText' => 'This is my blog details'
        ));
    }

    /**
     * @param $id
     * @return JsonResponse
     * @Route("/blog/post/{id}")
     * @Method({"PUT"})
     */
    public function editAction($id)
    {

        return new JsonResponse(array(
            'id' => $id,
            'status' => 'success'
        ));
    }

}