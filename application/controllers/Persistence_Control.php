<?php
/**
 *@author Prayag
 */
use models\Address;
use models\Forest,
	models\Plantation,
	models\Transaction,
	models\Tree,
	models\User,

	Doctrine\Common\Util\Debug;
/**
 *
 * http://example.com/index.php/Persistence_Control
 * @author prayag
 *
 */
class Persistence_Control extends CI_Controller{
	var $schemas;


	public function __construct(){
		parent::__construct();
		$this->schemas = array(	$this->doctrine->em->getClassMetadata('models\Address')
								//,$this->doctrine->em->getClassMetadata('models\Forest')
								//,$this->doctrine->em->getClassMetadata('models\Tree')
								,$this->doctrine->em->getClassMetadata('models\Plantation')
								,$this->doctrine->em->getClassMetadata('models\Transaction')
								,$this->doctrine->em->getClassMetadata('models\User')
						);

	}

	public function index(){
		print "f***";
	}

   /**
	 * Creates the database schema for the given array of ClassMetadata instances.
	 *
	 * @ReuestMapping(/persistence_control/create)
	 */

	public function create(){
		$this->drop();
		$this->doctrine->tool->createSchema($this->schemas);
		print "Fucking Schemas got created.<br/>";
	}

	public function drop(){
		$this->doctrine->tool->dropSchema($this->schemas);
		print "Fucking Schema got dropped.<br/>";
		return;
	}
}