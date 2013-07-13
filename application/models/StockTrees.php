<?php

namespace models;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="models\repository\StockTreesRepository")
 * @ORM\Table(name="StockTrees")
 */
class StockTrees {
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
	 * @ORM\OneToOne(targetEntity="models\Tree")
	 * @var Address
	 */
	private $tree;

   /**
	 * @ORM\Column(type="integer")
	 */
    private $stockNumber;

   /**
	 * @var datetime $registeredTimestamp
	 *
	 * @gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $endDate;

   /**
	 * @ORM\Column(type="integer")
	 */
    private $price;

   /**
	 * @ORM\Column(type="boolean")
	 */
    private $available=TRUE;




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

	public function getTree()
	{
	    return $this->tree;
	}

	public function setTree($tree)
	{
	    $this->tree = $tree;
	}

	public function getStockNumber()
	{
	    return $this->stockNumber;
	}

	public function setStockNumber($stockNumber)
	{
	    $this->stockNumber = $stockNumber;
	}

	public function getEndDate()
	{
	    return $this->endDate;
	}

	public function setEndDate($endDate)
	{
	    $this->endDate = $endDate;
	}

	public function getPrice()
	{
	    return $this->price;
	}

	public function setPrice($price)
	{
	    $this->price = $price;
	}

	public function getAvailable()
	{
	    return $this->available;
	}

	public function setAvailable($available)
	{
	    $this->available = $available;
	}
}
?>