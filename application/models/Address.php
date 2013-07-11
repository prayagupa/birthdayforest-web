<?php


namespace models;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="models\repository\AddressRepository")
 * @ORM\Table(name="Address")
 */
class Address {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $countryCode;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $countryName;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $countryPhoneCode;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $postalCode;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $city;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $state;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $district;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $zone;

	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
	private $streetNo;



	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getCountryCode()
	{
	    return $this->countryCode;
	}

	public function setCountryCode($countryCode)
	{
	    $this->countryCode = $countryCode;
	}

	public function getCountryName()
	{
	    return $this->countryName;
	}

	public function setCountryName($countryName)
	{
	    $this->countryName = $countryName;
	}

	public function getCountryPhoneCode()
	{
	    return $this->countryPhoneCode;
	}

	public function setCountryPhoneCode($countryPhoneCode)
	{
	    $this->countryPhoneCode = $countryPhoneCode;
	}

	public function getPostalCode()
	{
	    return $this->postalCode;
	}

	public function setPostalCode($postalCode)
	{
	    $this->postalCode = $postalCode;
	}

	public function getCity()
	{
	    return $this->city;
	}

	public function setCity($city)
	{
	    $this->city = $city;
	}

	public function getState()
	{
	    return $this->state;
	}

	public function setState($state)
	{
	    $this->state = $state;
	}

	public function getDistrict()
	{
	    return $this->district;
	}

	public function setDistrict($district)
	{
	    $this->district = $district;
	}

	public function getZone()
	{
	    return $this->zone;
	}

	public function setZone($zone)
	{
	    $this->zone = $zone;
	}

	public function getStreetNo()
	{
	    return $this->streetNo;
	}

	public function setStreetNo($streetNo)
	{
	    $this->streetNo = $streetNo;
	}
}
?>