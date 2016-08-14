<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Class ServiceController
 * @package AppBundle\Controller
 * When a controller is defined as service in services.yml, Symfony's base 'Controller' cannot be extended.
 * So, any service need for this controller has to be manually injected. See __construct().
 */
class ServiceController
{
    private $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    public function indexAction()
    {
        $number = rand(0, 100);

        return $this->templating->renderResponse('random/number.html.twig', array(
            'randomNumber' => $number
        ));
    }
}
