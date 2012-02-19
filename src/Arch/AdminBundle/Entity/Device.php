<?php

namespace Arch\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arch\AdminBundle\Entity\Device
 */
class Device
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $personalId
     */
    private $personalId;

    /**
     * @var string $inv
     */
    private $inv;

    /**
     * @var string $room
     */
    private $room;

    /**
     * @var string $producer
     */
    private $producer;

    /**
     * @var integer $year
     */
    private $year;

    /**
     * @var Arch\AdminBundle\Entity\Personal
     */
    private $personal;

    /**
     * @var Arch\AdminBundle\Entity\Hardware
     */
    private $hardware;

    /**
     * @var Arch\AdminBundle\Entity\Software
     */
    private $software;

    public function __construct()
    {
        $this->hardware = new \Doctrine\Common\Collections\ArrayCollection();
    $this->software = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set personalId
     *
     * @param integer $personalId
     */
    public function setPersonalId($personalId)
    {
        $this->personalId = $personalId;
    }

    /**
     * Get personalId
     *
     * @return integer 
     */
    public function getPersonalId()
    {
        return $this->personalId;
    }

    /**
     * Set inv
     *
     * @param string $inv
     */
    public function setInv($inv)
    {
        $this->inv = $inv;
    }

    /**
     * Get inv
     *
     * @return string 
     */
    public function getInv()
    {
        return $this->inv;
    }

    /**
     * Set room
     *
     * @param string $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

    /**
     * Get room
     *
     * @return string 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set producer
     *
     * @param string $producer
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    }

    /**
     * Get producer
     *
     * @return string 
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set year
     *
     * @param integer $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set personal
     *
     * @param Arch\AdminBundle\Entity\Personal $personal
     */
    public function setPersonal(\Arch\AdminBundle\Entity\Personal $personal)
    {
        $this->personal = $personal;
    }

    /**
     * Get personal
     *
     * @return Arch\AdminBundle\Entity\Personal 
     */
    public function getPersonal()
    {
        return $this->personal;
    }

    /**
     * Add hardware
     *
     * @param Arch\AdminBundle\Entity\Hardware $hardware
     */
    public function addHardware(\Arch\AdminBundle\Entity\Hardware $hardware)
    {
        $this->hardware[] = $hardware;
    }

    /**
     * Get hardware
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHardware()
    {
        return $this->hardware;
    }

    /**
     * Add software
     *
     * @param Arch\AdminBundle\Entity\Software $software
     */
    public function addSoftware(\Arch\AdminBundle\Entity\Software $software)
    {
        $this->software[] = $software;
    }

    /**
     * Get software
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSoftware()
    {
        return $this->software;
    }
}