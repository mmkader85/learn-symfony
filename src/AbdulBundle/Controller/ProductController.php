<?php

/**
 * Using Entity/Entities
 * Create Query
 * Query Builder
 * Custom Repository Function
 */

namespace AbdulBundle\Controller;

use AbdulBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductController
 * @package AbdulBundle\Controller
 * php app/console doctrine:generate:entity
 * Chapter 10 - Controller 10
 */
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

    public function createQueryAction($minPrice)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p FROM AbdulBundle:Product p WHERE p.price > :price ORDER BY p.price ASC'
        )->setParameter('price', $minPrice);

        //$result = $query->getResult();
        //$result = $query->setMaxResults(2)->getResult();
        $result = $query->setMaxResults(1)->getOneOrNullResult();

        dump($result);

        return new Response();
    }

    public function queryBuilderAction($minPrice)
    {
        $productRepo = $this->getDoctrine()->getManager()->getRepository('AbdulBundle:Product');
        $query = $productRepo->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', $minPrice)
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $result = $query->getResult();
        //$result = $query->setMaxResults(2)->getResult();
        //$result = $query->setMaxResults(1)->getOneOrNullResult();

        dump($result);

        return new Response();
    }

    public function customRepoFunctionAction()
    {
        $products = $this->getDoctrine()->getManager()
            ->getRepository('AbdulBundle:Product')
            ->findAllOrderedByPrice();

        dump($products);

        return new Response();
    }

    public function getOneProductAction()
    {
        $em = $this->getDoctrine()->getManager();
        $minPrice = 10;
        $query = $em->createQuery('SELECT p FROM AbdulBundle:Product p WHERE p.price > :price')
            ->setParameter('price', $minPrice);
        $result = $query->setMaxResults(1)->getOneOrNullResult();

        return $result;
    }
}
