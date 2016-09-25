<?php

namespace AbdulBundle\Controller;

use AbdulBundle\Entity\CommunicationPreferencesNew;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommunicationPreferencesNewController extends Controller
{
    public function saveAction()
    {
        $records = array(
            0 => array(
                'id' => 4,
                'market_news' => 'WEEKLY',
                'market_news_sms' => 1
            ),
            1 => array(
                'id' => 5,
                'market_news' => 'DAILY',
                'market_news_sms' => 0
            )
        );
        
        $em = $this->getDoctrine()->getManager();
        $communicationPreferencesNew = new CommunicationPreferencesNew();
        $communicationPreferencesNew->setId($records[0]['id']);
        $communicationPreferencesNew->setMarketNews($records[0]['market_news']);
        $communicationPreferencesNew->setMarketNewsSms($records[0]['market_news_sms']);
        $em->persist($communicationPreferencesNew);
        
        $communicationPreferencesNew = new CommunicationPreferencesNew();
        $communicationPreferencesNew->setId($records[1]['id']);
        $communicationPreferencesNew->setMarketNews($records[1]['market_news']);
        $communicationPreferencesNew->setMarketNewsSms($records[1]['market_news_sms']);
        $em->persist($communicationPreferencesNew);
        
        $em->flush();

        return new Response('Saved');
    }

    public function getByPrimaryKeyAction($personId)
    {
        $em = $this->getDoctrine()->getManager();
        $communicationPreferencesNew = $em->getRepository('AbdulBundle:CommunicationPreferencesNew')->find($personId);

        if(!$communicationPreferencesNew) {
            throw $this->createNotFoundException('Communication Preferences New not found with id : '.$personId);
        }
        
        //dump($communicationPreferencesNew); exit;

        return $this->render('AbdulBundle:CommunicationPreferencesNew:getCommunicationPreferencesNew.html.twig',
            array(
                'communicationPreferencesNew' => $communicationPreferencesNew
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
