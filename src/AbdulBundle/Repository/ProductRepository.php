<?php

namespace AbdulBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Custom function. Used in ProductController.php
     * @return array
     */
    public function findAllOrderedByName()
    {

        return $this->getEntityManager()
            ->createQuery('SELECT p FROM AbdulBundle:Product p ORDER BY p.name ASC')
            ->getArrayResult();
    }

    /**
     * Custom function. Used in ProductController.php
     * @return array
     */
    public function findAllOrderedByPrice()
    {

        return $this->getEntityManager()
            ->createQuery('SELECT p FROM AbdulBundle:Product p ORDER BY p.price ASC')
            ->getArrayResult();
    }
}
