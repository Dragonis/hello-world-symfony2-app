<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mountain
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mountain
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="hight", type="integer")
     */
    private $hight;


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
     * Set name
     *
     * @param string $name
     * @return Mountain
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set hight
     *
     * @param integer $hight
     * @return Mountain
     */
    public function setHight($hight)
    {
        $this->hight = $hight;

        return $this;
    }

    /**
     * Get hight
     *
     * @return integer 
     */
    public function getHight()
    {
        return $this->hight;
    }
}
