<?php
// src/AppBundle/Entity/User.php

namespace GeoBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    private $country;
    private $city;
    private $language;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
    /**
     * @var integer
     */
    private $point;

    /**
     * @var integer
     */
    private $current1;

    /**
     * @var integer
     */
    private $current2;

    /**
     * @var integer
     */
    private $current3;

    /**
     * @var integer
     */
    private $current4;

    /**
     * @var integer
     */
    private $current5;

    /**
     * @var integer
     */
    private $current6;


    /**
     * Set point
     *
     * @param integer $point
     *
     * @return User
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return integer
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set current1
     *
     * @param integer $current1
     *
     * @return User
     */
    public function setCurrent1($current1)
    {
        $this->current1 = $current1;

        return $this;
    }

    /**
     * Get current1
     *
     * @return integer
     */
    public function getCurrent1()
    {
        return $this->current1;
    }

    /**
     * Set current2
     *
     * @param integer $current2
     *
     * @return User
     */
    public function setCurrent2($current2)
    {
        $this->current2 = $current2;

        return $this;
    }

    /**
     * Get current2
     *
     * @return integer
     */
    public function getCurrent2()
    {
        return $this->current2;
    }

    /**
     * Set current3
     *
     * @param integer $current3
     *
     * @return User
     */
    public function setCurrent3($current3)
    {
        $this->current3 = $current3;

        return $this;
    }

    /**
     * Get current3
     *
     * @return integer
     */
    public function getCurrent3()
    {
        return $this->current3;
    }

    /**
     * Set current4
     *
     * @param integer $current4
     *
     * @return User
     */
    public function setCurrent4($current4)
    {
        $this->current4 = $current4;

        return $this;
    }

    /**
     * Get current4
     *
     * @return integer
     */
    public function getCurrent4()
    {
        return $this->current4;
    }

    /**
     * Set current5
     *
     * @param integer $current5
     *
     * @return User
     */
    public function setCurrent5($current5)
    {
        $this->current5 = $current5;

        return $this;
    }

    /**
     * Get current5
     *
     * @return integer
     */
    public function getCurrent5()
    {
        return $this->current5;
    }

    /**
     * Set current6
     *
     * @param integer $current6
     *
     * @return User
     */
    public function setCurrent6($current6)
    {
        $this->current6 = $current6;

        return $this;
    }

    /**
     * Get current6
     *
     * @return integer
     */
    public function getCurrent6()
    {
        return $this->current6;
    }
}
