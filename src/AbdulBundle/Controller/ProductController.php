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

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        $products[0]['id'] = $product->getId();

        return $this->render('AbdulBundle:Product:save.html.twig',
            array(
                'products' => $products
            )
        );
    }

    public function getByPrimaryKeyAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AbdulBundle:Product')->find($productId);

        if(!$product) {
            throw $this->createNotFoundException('Product not found with id : '.$productId);
        }

        return $this->render('AbdulBundle:Product:getByPrimaryKey.html.twig',
            array(
                'product' => $product
            )
        );
    }

    public function findAction($price)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AbdulBundle:Product')->findBy(
            array(
                'price' => $price,
            )
        );

        var_dump($product);

        return new Response('Find Action');
    }

    public function updateAction($id, $price)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AbdulBundle:Product')->find($id);

        if(!$product) {
            throw $this->createNotFoundException('Product not found with id : '.$id);
        }

        $product->setPrice($price);
        $em->flush();

        return $this->render('AbdulBundle:Product:getByPrimaryKey.html.twig',
            array(
                'product' => $product
            )
        );
    }

    public function deleteAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AbdulBundle:Product')->find($productId);

        if(!$product) {
            throw $this->createNotFoundException('Product not found with id : '.$productId);
        }

        $em->remove($product);
        $em->flush();

        return new Response('Product with ID '.$productId.' has been successfully deleted');
    }
}
