<?php

namespace models;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="models\repository\ForestRepository")
 * @ORM\Table(name="Forest")
 */
class Forest {
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
    private $address;

   /**
	 * @ORM\OneToMany(targetEntity="models\Stock", mappedBy="forest")
	 */
	private $stocks;

   /**
	 * @ORM\Column(type="boolean")
	 */
    private $active=TRUE;



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

	public function getAddress()
	{
	    return $this->address;
	}

	public function setAddress($address)
	{
	    $this->address = $address;
	}

	public function getStocks()
	{
	    return $this->stocks;
	}

	public function setStocks($stocks)
	{
	    $this->stocks = $stocks;
	}

	public function getActive()
	{
	    return $this->active;
	}

	public function setActive($active)
	{
	    $this->active = $active;
	}
}
?>