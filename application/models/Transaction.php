<?php
namespace models;

//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="models\repository\TransactionRepository")
 * @ORM\Table(name="Transaction")
 */

class Transaction {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    private $id;

   /**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $gateway;


   /**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
    private $gatewayTransactionId;

   /**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
    private $chqNo;

   /**
	 * @ORM\Column(type="integer", nullable=false)
	 */
    private $amount;


   /**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $status;

    /**
	 * @var datetime $created
	 *
	 * @gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
    private $created;



	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getGateway()
	{
	    return $this->gateway;
	}

	public function setGateway($gateway)
	{
	    $this->gateway = $gateway;
	}

	public function getChqNo()
	{
	    return $this->chqNo;
	}

	public function setChqNo($chqNo)
	{
	    $this->chqNo = $chqNo;
	}

	public function getAmount()
	{
	    return $this->amount;
	}

	public function setAmount($amount)
	{
	    $this->amount = $amount;
	}

	public function getStatus()
	{
	    return $this->status;
	}

	public function setStatus($status)
	{
	    $this->status = $status;
	}

	public function getCreated()
	{
	    return $this->created;
	}

	public function setCreated($created)
	{
	    $this->created = $created;
	}

	public function getGatewayTransactionId()
	{
	    return $this->gatewayTransactionId;
	}

	public function setGatewayTransactionId($gatewayTransactionId)
	{
	    $this->gatewayTransactionId = $gatewayTransactionId;
	}
}
?>