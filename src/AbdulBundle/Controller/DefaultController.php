<?php

namespace AbdulBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package AbdulBundle\Controller
 * php app/console generate:bundle --namespace=AbdulBundle
 * Chapter 9 - Controller 9
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AbdulBundle:Default:index.html.twig');
    }
}
