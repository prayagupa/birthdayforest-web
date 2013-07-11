<?php

namespace models;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use models\Address;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="models\repository\UserRepository")
 * @ORM\Table(name="User")
 */

class User {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 * @var password
	 */
	private $password;

   /**
	 * @ORM\Column(type="string", length=255)
	 */
	private $screenName;

   /**
	 * @ORM\Column(type="string", length=50)
	 */
	private $phone;

	/**
	 * @var \models\constants\Gender
	 * @ORM\Column(type="string", length=10, nullable=false)
	 */
	private $gender	;

	/**
	 * @var datetime $bornDate
	 *
	 * @gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $dob;

   /**
	 * @var datetime $registeredTimestamp
	 *
	 * @gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $registeredTimestamp;

   /**
	 * @ORM\Column(type="string", length=50)
	 */
	private $registerSource;

   /**
	 * @ORM\Column(type="string", length=50)
	 */
	private $registerIp;

   /**
	 * @ORM\Column(type="string", length=50)
	 */
	private $type;

   /**
	 * @ORM\Column(type="string", length=50)
	 */
	private $status;

   /**
	 * @ORM\Column(type="string", length=50)
	 */
	private $verified;

	/**
	 * @ORM\OneToOne(targetEntity="models\Address")
	 * @var Address
	 */
	private $address;


	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getPassword()
	{
	    return $this->password;
	}

	public function setPassword($password)
	{
	    $this->password = $password;
	}

	public function getScreenName()
	{
	    return $this->screenName;
	}

	public function setScreenName($screenName)
	{
	    $this->screenName = $screenName;
	}

	public function getPhone()
	{
	    return $this->phone;
	}

	public function setPhone($phone)
	{
	    $this->phone = $phone;
	}

	public function getGender()
	{
	    return $this->gender;
	}

	public function setGender($gender)
	{
	    $this->gender = $gender;
	}

	public function getDob()
	{
	    return $this->dob;
	}

	public function setDob($dob)
	{
	    $this->dob = $dob;
	}

	public function getRegisteredTimestamp()
	{
	    return $this->registeredTimestamp;
	}

	public function setRegisteredTimestamp($registeredTimestamp)
	{
	    $this->registeredTimestamp = $registeredTimestamp;
	}

	public function getRegisterSource()
	{
	    return $this->registerSource;
	}

	public function setRegisterSource($registerSource)
	{
	    $this->registerSource = $registerSource;
	}

	public function getRegisterIp()
	{
	    return $this->registerIp;
	}

	public function setRegisterIp($registerIp)
	{
	    $this->registerIp = $registerIp;
	}

	public function getType()
	{
	    return $this->type;
	}

	public function setType($type)
	{
	    $this->type = $type;
	}

	public function getStatus()
	{
	    return $this->status;
	}

	public function setStatus($status)
	{
	    $this->status = $status;
	}

	public function getVerified()
	{
	    return $this->verified;
	}

	public function setVerified($verified)
	{
	    $this->verified = $verified;
	}

	public function getAddress()
	{
	    return $this->address;
	}

	public function setAddress($address)
	{
	    $this->address = $address;
	}
}
?>