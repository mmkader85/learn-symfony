<?php

namespace AbdulBundle\Controller;

use AbdulBundle\Entity\Category;
use AbdulBundle\Entity\Product;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RelatedEntitiesController
 * @package AbdulBundle\Controller
 * Chapter 10 - Controller 11
 */
class RelatedEntitiesController extends Controller
{
    /**
     * @Route("/entities-save", name="related_entities_save")
     * @return Response
     */
    public function saveAction()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Logitech Keyboard');
        $product->setPrice(20.5);
        $product->setDescription('Wireless and Backlight Keyboard');
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->persist($category);
        $em->flush();

        return new Response(
            'Product and Category added.'.'<br />'.
            'Category ID : '.$category->getId().'<br />'.
            'Product ID : '.$product->getId()
        );
    }

    /**
     * @Route("/entities-get/{productId}", requirements={"productId": "\d+"}, name="related_entities_get")
     * @param $productId
     * @return Response
     */
    public function getAction($productId)
    {
        $productRepo = $this->getDoctrine()->getManager()->getRepository('AbdulBundle:Product');
        $product = $productRepo->find($productId);

        if(!$product) {
            throw $this->createNotFoundException('Product with ID: '.$productId.' not found in system');
        }

        $productName = $product->getName();
        $categoryName = is_object($product->getCategory()) ? $product->getCategory()->getName() : 'Not Found';

        return new Response(
            'Product Name : '.$productName.'<br />'.
            'Category Name : '.$categoryName
        );
    }
}