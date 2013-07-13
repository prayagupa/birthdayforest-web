<?php

namespace models;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="models\repository\HoleRepository")
 * @ORM\Table(name="Hole")
 */
class Hole {
   /**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    private $id;

	/**
	 *@ORM\ManyToOne(targetEntity="models\Stock", cascade={"persist"})
	 */
	private $stock;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $latitude;

   /**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $longitude;



	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getStock()
	{
	    return $this->stock;
	}

	public function setStock($stock)
	{
	    $this->stock = $stock;
	}

	public function getLatitude()
	{
	    return $this->latitude;
	}

	public function setLatitude($latitude)
	{
	    $this->latitude = $latitude;
	}

	public function getLongitude()
	{
	    return $this->longitude;
	}

	public function setLongitude($longitude)
	{
	    $this->longitude = $longitude;
	}
}
?>