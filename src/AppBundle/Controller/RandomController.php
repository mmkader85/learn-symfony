<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class RandomController
 * @package AppBundle\Controller
 * Chapter 4 - Controller 2
 */
class RandomController extends Controller
{
    /**
     * @Route("/random/number", name="random-number")
     */
    public function numberAction()
    {
        $number = rand(0, 100);
        
        return new Response(
            '<html><body>Random number is '.$number.'</body></html>'
        );
    }
    
    /**
     * @Route("/api/random/number")
     */
    public function apiNumberAction()
    {
        $data = array(
            'random_number' => rand(0, 100)
        );
        
//        return new Response(
//            json_encode($data),
//            200,
//            array('Content-Type', 'application/json')
//        );
        
        return new JsonResponse($data);
    }
    
    /**
     * @Route("random/numbers/{count}")
     */
    public function numbersAction($count)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = $numbers;
        
//        return new Response(
//            '<html><body>'.$count.' Random Numbers are '.  implode(', ', $numbersList).'</body></html>'
//        );
        
//        $html = $this->render('random/numbers.html.twig', array('randomNumbersList' => $numbersList));

        $html = $this->container->get('templating')->render(
            'random/numbers.html.twig',
            array('randomNumbersList' => $numbersList)
        );
        
        return new Response($html);
    }
    
}
