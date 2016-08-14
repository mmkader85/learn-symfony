<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RouterController extends Controller
{

    /**
     * @param $slug
     * @return Response
     * @Route("/router/show/{slug}", name="app-router-show")
     */
    public function showAction($slug)
    {
        $params = $this->get('router')->match('/site/router/show/my-post');
        echo 'Matched router for : /site/router/show/my-post ';
        print_r($params);

        //$url = $this->get('router')->generate('app-router-show', array('slug' => 'my-first-post'));
        $url = $this->generateUrl('app-router-show', array('slug' => 'my-first-post'), UrlGeneratorInterface::ABSOLUTE_URL);
        print_r($url);

        //Undefined parameters to generateUrl will become query strings.
        $urlWithQueryString = $this->generateUrl('app-router-show', array(
                'slug' => 'my-first-post',
                'category' => 'electronics',
                'page' => 2
            )
        );
        var_dump($urlWithQueryString);

        return new Response('A Page');
    }

    /**
     * @return Response
     * @Route("/router/path")
     */
    public function pathAction()
    {

        return $this->render('AppBundle:Router:path.html.twig');
    }

    /**
     * @param Request $request
     * @param $page
     * Route information for this controller is from 'app/config/routing_dev.yml'
     */
    public function ymlRouterAction(Request $request, $page)
    {
        $title = $request->attributes->get('title');

        var_dump($page);
        var_dump($title);

        exit;
    }
}