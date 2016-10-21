<?php

namespace BlogBundle\Controller;

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
        return $this->render('BlogBundle:Default:index.html.twig');
    }
}
