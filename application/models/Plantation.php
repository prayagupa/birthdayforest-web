<?php

namespace models;
use models\constants\PlantationStatus;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="models\repository\PlantationRepository")
 * @ORM\Table(name="Plantation")
 */

class Plantation {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    private $id;

   /**
	 * @ORM\OneToOne(targetEntity="models\User")
	 */
    private $user;

   /**
	 * @ORM\OneToMany(targetEntity="models\User", mappedBy="plantation")

    private $users;
	 */

   /**
	 * @var PlantationStatus
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
    private $status=PlantationStatus::PENDING;

   /**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
    private $description;

   /**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $type;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $plantationFor;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $source;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $plantationIp;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
    private $quantity;

    /**
	 * @var datetime $created
	 *
	 * @gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
    private $requestedDate;

    /**
	 * @var datetime $created
	 *
	 * @gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
    private $plantationDate;

   /**
	 * @ORM\OneToOne(targetEntity="models\User")
	 */
    private $approvedBy;

   /**
	 * @ORM\OneToOne(targetEntity="models\Invoice")

    private $invoice;
	 */

   /**
	 * @ORM\OneToOne(targetEntity="models\Transaction", cascade={"persist"})
	 */
    private $transaction;

   /**
	 * @ORM\OneToMany(targetEntity="models\PlantationHoles", mappedBy="plantation", cascade={"all"})
	 */
    private $holes;

   	public function getId()
   	{
   	    return $this->id;
   	}

   	public function setId($id)
   	{
   	    $this->id = $id;
   	}

   	public function getUser()
   	{
   	    return $this->user;
   	}

   	public function setUser($user)
   	{
   	    $this->user = $user;
   	}

   	public function getStatus()
   	{
   	    return $this->status;
   	}

   	public function setStatus($status)
   	{
   	    $this->status = $status;
   	}

   	public function getDescription()
   	{
   	    return $this->description;
   	}

   	public function setDescription($description)
   	{
   	    $this->description = $description;
   	}

   	public function getType()
   	{
   	    return $this->type;
   	}

   	public function setType($type)
   	{
   	    $this->type = $type;
   	}

   	public function getPlantationFor()
   	{
   	    return $this->plantationFor;
   	}

   	public function setPlantationFor($plantationFor)
   	{
   	    $this->plantationFor = $plantationFor;
   	}

   	public function getSource()
   	{
   	    return $this->source;
   	}

   	public function setSource($source)
   	{
   	    $this->source = $source;
   	}

   	public function getPlantationIp()
   	{
   	    return $this->plantationIp;
   	}

   	public function setPlantationIp($plantationIp)
   	{
   	    $this->plantationIp = $plantationIp;
   	}

   	public function getQuantity()
   	{
   	    return $this->quantity;
   	}

   	public function setQuantity($quantity)
   	{
   	    $this->quantity = $quantity;
   	}

   	public function getRequestedDate()
   	{
   	    return $this->requestedDate;
   	}

   	public function setRequestedDate($requestedDate)
   	{
   	    $this->requestedDate = $requestedDate;
   	}

   	public function getPlantationDate()
   	{
   	    return $this->plantationDate;
   	}

   	public function setPlantationDate($plantationDate)
   	{
   	    $this->plantationDate = $plantationDate;
   	}

   	public function getApprovedBy()
   	{
   	    return $this->approvedBy;
   	}

   	public function setApprovedBy($approvedBy)
   	{
   	    $this->approvedBy = $approvedBy;
   	}

   	public function getTransaction()
   	{
   	    return $this->transaction;
   	}

   	public function setTransaction($transaction)
   	{
   	    $this->transaction = $transaction;
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
