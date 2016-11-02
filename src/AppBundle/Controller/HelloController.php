<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HelloController
 * @package AppBundle\Controller
 * Chapter 5 - Controller 3
 */
class HelloController extends Controller
{
    /**
     * @Route("/hello/{firstName}/{lastName}/{title}")
     */
    public function indexAction($firstName, $lastName, $title = '') // (or) ($lastName, $firstName, $title = '')
    {
        return $this->render('@App/Hello/index.html.twig', 
            array(
                'title' => $title,
                'firstName' => $firstName,
                'lastName' => $lastName
            )
        );
        
        /*return new Response(
            '<html><body>Hello '.$title.' '.$firstName.' '.$lastName.'</body></html>'
        );*/
    }
    
    /**
     * @Route("/redirect")
     */
    public function redirectAction()
    {
        
        //return $this->redirectToRoute('random-number');
        //return $this->redirect($this->generateUrl('random-number'));
        return new \Symfony\Component\HttpFoundation\RedirectResponse($this->generateUrl('random-number'));
        //return new \Symfony\Component\HttpFoundation\RedirectResponse('http://www.propertyguru.com.sg');
    }
    
    /**
     * @Route("/exception")
     */
    public function exceptionAction()
    {
        throw $this->createNotFoundException('Abdul\'s sample exception message');
        
        return new Response('Some content');
    }

    /**
     * @Route("/forward")
     */
    public function forwardAction()
    {

        return $this->forward('AppBundle:Hello:hi',
            array(
                'name' => 'Muhammed'
            )
        );
    }

    /**
     * @param $name
     * @return Response
     */
    public function hiAction($name)
    {

        return new Response('Hi '.$name);
    }
}