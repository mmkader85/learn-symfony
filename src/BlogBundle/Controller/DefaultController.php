<?php

namespace BlogBundle\Controller;

use BlogBundle\Service\BlogService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package BlogBundle\Controller
 *
 * Chapter 6 - Controller 12
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        BlogService::sum(10, 15);
        $data['sum1'] = BlogService::getSum();

        BlogService::sum(20, 25);
        $data['sum2'] = BlogService::getSum();
        return $this->render('BlogBundle:Default:index.html.twig', $data);
    }
}
