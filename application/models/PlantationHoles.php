<?php

namespace models;
use models\constants\PlantationStatus;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="models\repository\PlantationHolesRepository")
 * @ORM\Table(name="PlantationHoles")
 */

class PlantationHoles {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
    private $id;

   /**
	 * @ORM\OneToOne(targetEntity="models\Plantation")
	 */
    private $plantation;

   /**
	 * @ORM\OneToOne(targetEntity="models\Hole")
	 */
    private $hole;

   /**
	 * @ORM\OneToOne(targetEntity="models\Tree")
	 */
    private $tree;

   /**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 */
    private $treeCode;



	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	}

	public function getPlantation()
	{
	    return $this->plantation;
	}

	public function setPlantation($plantation)
	{
	    $this->plantation = $plantation;
	}

	public function getHole()
	{
	    return $this->hole;
	}

	public function setHole($hole)
	{
	    $this->hole = $hole;
	}

	public function getTree()
	{
	    return $this->tree;
	}

	public function setTree($tree)
	{
	    $this->tree = $tree;
	}

	public function getTreeCode()
	{
	    return $this->treeCode;
	}

	public function setTreeCode($treeCode)
	{
	    $this->treeCode = $treeCode;
	}
}
?>