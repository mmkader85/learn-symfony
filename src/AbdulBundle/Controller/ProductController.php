<?php

namespace AbdulBundle\Controller;

use AbdulBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function saveAction()
    {
        $products = array(
            0 => array(
                'name' => 'Logitech Mouse',
                'price' => 19.5,
                'description' => 'Brand new Logitech bluetooth mouse.'
            )
        );

        $product = new Product();
        $product->setName($products[0]['name']);
        $product->setPrice($products[0]['price']);
        $product->setDescription($products[0]['description']);

        $doctrineManager = $this->getDoctrine()->getManager();
        $doctrineManager->persist($product);
        $doctrineManager->flush();
        $products[0]['id'] = $product->getId();

        return $this->render('AbdulBundle:Product:save.html.twig',
            array(
                'products' => $products
            )
        );
    }

    public function getByPrimaryKeyAction($productId)
    {
        $productRepo = $this->getDoctrine()->getRepository('AbdulBundle:Product');
        $product = $productRepo->find($productId);

        dump($product);

        return $this->render('AbdulBundle:Product:getByPrimaryKey.html.twig',
            array(
                'product' => $product
            )
        );
    }

    public function findAction($price)
    {
        $productRepo = $this->getDoctrine()->getRepository('AbdulBundle:Product');
        $product = $productRepo->findBy(
            array(
                'price' => $price,
            )
        );

        var_dump($product);

        return new Response('Find Action');
    }
}
