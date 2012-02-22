<?php

namespace Arch\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arch\AdminBundle\Entity\Hardware
 */
class Hardware
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $hardwareTypeId
     */
    private $hardwareTypeId;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var Arch\AdminBundle\Entity\HardwareType
     */
    private $hardwareType;

    /**
     * @var Arch\AdminBundle\Entity\Device
     */
    private $computer;

    public function __construct()
    {
        $this->computer = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set hardwareTypeId
     *
     * @param integer $hardwareTypeId
     */
    public function setHardwareTypeId($hardwareTypeId)
    {
        $this->hardwareTypeId = $hardwareTypeId;
    }

    /**
     * Get hardwareTypeId
     *
     * @return integer 
     */
    public function getHardwareTypeId()
    {
        return $this->hardwareTypeId;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set hardwareType
     *
     * @param Arch\AdminBundle\Entity\HardwareType $hardwareType
     */
    public function setHardwareType(\Arch\AdminBundle\Entity\HardwareType $hardwareType)
    {
        $this->hardwareType = $hardwareType;
    }

    /**
     * Get hardwareType
     *
     * @return Arch\AdminBundle\Entity\HardwareType 
     */
    public function getHardwareType()
    {
        return $this->hardwareType;
    }

    /**
     * Add computer
     *
     * @param Arch\AdminBundle\Entity\Device $computer
     */
    public function addDevice(\Arch\AdminBundle\Entity\Device $computer)
    {
        $this->computer[] = $computer;
    }

    /**
     * Get computer
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComputer()
    {
        return $this->computer;
    }

    public function __toString()
    {
        return $this->getName();
    }
}