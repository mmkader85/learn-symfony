<?php

namespace AbdulBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AbdulBundle:Default:index.html.twig');
    }
}
