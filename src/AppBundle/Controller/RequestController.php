<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RequestController extends Controller
{
    /**
     * @Route("/request-object")
     */
    public function requestObjectAction(Request $request)
    {
        $server = $request->server;
        dump($server);
        exit;
    }
    
    /**
     * @Route("/set-session/{name}")
     */
    public function setSessionAction($name, Request $request)
    {
        $session = $request->getSession();
        $session->set('name', $name);
        
        return $this->render('@App/Request/set-session.html.twig', 
            array(
                'name' => $name,
                'getSessionUrl' => $this->generateUrl('getSession')
            )
        );
    }
    
    /**
     * @Route("/get-session", name="getSession")
     */
    public function getSessionAction(Request $request)
    {
        $session = $request->getSession();
        $sessionNameValue = $session->get('name', 'Default Session Name');
        
        return $this->render('@App/Request/get-session.html.twig', 
            array(
                'name' => $sessionNameValue,
                'removeSessionUrl' => $this->generateUrl('removeSession')
            )
        );
    }
    
    /**
     * @Route("/destroy-session", name="removeSession")
     */
    public function removeSessionAction(Request $request)
    {
        $session = $request->getSession();
        $sessionName = $session->get('name');
        $session->remove('name');

        return $this->render('@App/Request/remove-session.html.twig', 
            array(
                'sessionName' => $sessionName,
                'getSessionUrl' => $this->generateUrl('getSession')
            )
        );
    }
    
    /**
     * @Route("/set-flash")
     */
    public function setFlashAction()
    {
        $this->addFlash('notice', 'This is first flash message');
        $this->addFlash('notice', 'This is second flash message');
        
        return $this->redirectToRoute('getFlash');
    }
    
    /**
     * @Route("/get-flash", name="getFlash")
     */
    public function getFlashAction()
    {   
        
        return $this->render('@App/Request/get-flash.html.twig');
    }

    /**
     * @Route("/flash-css", name="flash-css")
     */
    public function flashCssAction()
    {
        $style = '.flashNotice{padding:10px; background-color: #5eb5e0; border: 1px dotted #0000F0; width: 400px; margin-bottom: 5px;}';
        $response = new Response($style);
        $response->headers->set('content-type', 'text/css');

        return $response;
    }
    
}
