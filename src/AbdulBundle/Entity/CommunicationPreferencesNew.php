<?php

namespace AbdulBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunicationPreferencesNew
 *
 * @ORM\Table(name="communication_preferences_new")
 * @ORM\Entity(repositoryClass="AbdulBundle\Repository\CommunicationPreferencesNewRepository")
 */
class CommunicationPreferencesNew
{
    /**
     * @var int
     *
     * @ORM\Column(name="person_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="market_news", type="string", length=12)
     */
    private $marketNews;

    /**
     * @var int
     *
     * @ORM\Column(name="market_news_sms", type="integer")
     */
    private $marketNewsSms;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set id
     *
     * @param integer $id
     *
     * @return CommunicationPreferencesNew
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set marketNews
     *
     * @param string $marketNews
     *
     * @return CommunicationPreferencesNew
     */
    public function setMarketNews($marketNews)
    {
        $this->marketNews = $marketNews;

        return $this;
    }

    /**
     * Get marketNews
     *
     * @return string
     */
    public function getMarketNews()
    {
        return $this->marketNews;
    }

    /**
     * Set marketNewsSms
     *
     * @param integer $marketNewsSms
     *
     * @return CommunicationPreferencesNew
     */
    public function setMarketNewsSms($marketNewsSms)
    {
        $this->marketNewsSms = $marketNewsSms;

        return $this;
    }

    /**
     * Get marketNewsSms
     *
     * @return int
     */
    public function getMarketNewsSms()
    {
        return $this->marketNewsSms;
    }
}

