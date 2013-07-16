<?php

namespace models;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="models\repository\TreeRepository")
 * @ORM\Table(name="Tree")
 */
class Tree {
   /**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    private $id;

   /**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $name;

   /**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $scientificName;

   /**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
    private $localName;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
    private $description;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $image;

	/**
	 * @ORM\Column(type="integer")
	 */
    private $lifespan;



    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getScientificName()
    {
        return $this->scientificName;
    }

    public function setScientificName($scientificName)
    {
        $this->scientificName = $scientificName;
    }

    public function getLocalName()
    {
        return $this->localName;
    }

    public function setLocalName($localName)
    {
        $this->localName = $localName;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getLifespan()
    {
        return $this->lifespan;
    }

    public function setLifespan($lifespan)
    {
        $this->lifespan = $lifespan;
    }
}
?>