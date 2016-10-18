<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogController
 * @package AppBundle\Controller
 * Chapter 6 - Controller 5
 */
class BlogController extends Controller
{
    /**
     * @param $page
     * @Route("/blog/{page}", defaults={"page"=1}, requirements={"page"="\d+"})
     * This route matches /blog (without page number) and /blog/2 (with page number)
     * @return Response
     */
    public function indexAction($page)
    {

        return new Response('My Blog List');
    }

    /**
     * @param $slug
     * @return Response
     * @Route("/blog/{slug}", name="app-blog-show")
     */
    public function showAction($slug)
    {
        $params = $this->get('router')->match('/site/blog/my-blog-post');
        var_dump($params);

        //$url = $this->get('router')->generate('app-blog-show', array('slug' => 'my-first-post'));
        $url = $this->generateUrl('app-blog-show', array('slug' => 'my-first-post'));
        var_dump($url);

        return new Response('A Blog Details Page');
    }
}