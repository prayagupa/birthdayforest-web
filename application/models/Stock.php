<?php

namespace models;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="models\repository\StockRepository")
 * @ORM\Table(name="Stock")
 */
class Stock {
   /**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    private $id;

	/**
	 *@ORM\ManyToOne(targetEntity="models\Forest", cascade={"persist"})
	 */
	private $forest;

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
	private $startDate;


   /**
	 * @var datetime $registeredTimestamp
	 *
	 * @gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $endDate;


   /**
	 * @ORM\OneToMany(targetEntity="models\StockTrees", mappedBy="stock")
	 */
	private $stockTrees;


   /**
	 * @ORM\OneToMany(targetEntity="models\Hole", mappedBy="stock")
	 */
	private $holes;

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

	public function getForest()
	{
	    return $this->forest;
	}

	public function setForest($forest)
	{
	    $this->forest = $forest;
	}

	public function getStockNumber()
	{
	    return $this->stockNumber;
	}

	public function setStockNumber($stockNumber)
	{
	    $this->stockNumber = $stockNumber;
	}

	public function getStartDate()
	{
	    return $this->startDate;
	}

	public function setStartDate($startDate)
	{
	    $this->startDate = $startDate;
	}

	public function getEndDate()
	{
	    return $this->endDate;
	}

	public function setEndDate($endDate)
	{
	    $this->endDate = $endDate;
	}

	public function getAvailable()
	{
	    return $this->available;
	}

	public function setAvailable($available)
	{
	    $this->available = $available;
	}



	public function getStockTrees()
	{
	    return $this->stockTrees;
	}

	public function setStockTrees($stockTrees)
	{
	    $this->stockTrees = $stockTrees;
	}

	public function getHoles()
	{
	    return $this->holes;
	}

	public function setHoles($holes)
	{
	    $this->holes = $holes;
	}
}
?>