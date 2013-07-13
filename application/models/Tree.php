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
    private $picture;

	/**
	 * @ORM\Column(type="integer")
	 */
    private $lifespan;
}
?>