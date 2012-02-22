<?php

namespace Arch\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arch\AdminBundle\Entity\Software
 */
class Software
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $licenseId
     */
    private $licenseId;

    /**
     * @var integer $softwareTypeId
     */
    private $softwareTypeId;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var integer $year
     */
    private $year;

    /**
     * @var Arch\AdminBundle\Entity\License
     */
    private $license;

    /**
     * @var Arch\AdminBundle\Entity\SoftwareType
     */
    private $softwareType;

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
     * Set licenseId
     *
     * @param integer $licenseId
     */
    public function setLicenseId($licenseId)
    {
        $this->licenseId = $licenseId;
    }

    /**
     * Get licenseId
     *
     * @return integer 
     */
    public function getLicenseId()
    {
        return $this->licenseId;
    }

    /**
     * Set softwareTypeId
     *
     * @param integer $softwareTypeId
     */
    public function setSoftwareTypeId($softwareTypeId)
    {
        $this->softwareTypeId = $softwareTypeId;
    }

    /**
     * Get softwareTypeId
     *
     * @return integer 
     */
    public function getSoftwareTypeId()
    {
        return $this->softwareTypeId;
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
     * Set license
     *
     * @param Arch\AdminBundle\Entity\License $license
     */
    public function setLicense(\Arch\AdminBundle\Entity\License $license)
    {
        $this->license = $license;
    }

    /**
     * Get license
     *
     * @return Arch\AdminBundle\Entity\License 
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Set softwareType
     *
     * @param Arch\AdminBundle\Entity\SoftwareType $softwareType
     */
    public function setSoftwareType(\Arch\AdminBundle\Entity\SoftwareType $softwareType)
    {
        $this->softwareType = $softwareType;
    }

    /**
     * Get softwareType
     *
     * @return Arch\AdminBundle\Entity\SoftwareType 
     */
    public function getSoftwareType()
    {
        return $this->softwareType;
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