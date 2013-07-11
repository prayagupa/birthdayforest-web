<?php
/**
 *@author Prayag
 */
use models\constants\Gender;
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
		$this->createRootUser();
	}

	public function drop(){
		$this->doctrine->tool->dropSchema($this->schemas);
		print "Fucking Schema got dropped.<br/>";
		return;
	}


	/**
	 *
	 * create Root User
	 */
	public function createRootUser(){
		 $user = new User();
		 $user->setUsername("prayagupd");
		 $user->setGender(Gender::MALE);
		 $user->setName("Prayag Upd");
		 $user->setPassword("123456");
		 $user->setPhone("9849026704");
		 $user->setStatus(1);
		 $user->setEmail("prayag.upd@gmail.com");
		 $user->setRegisterSource("WEB");
		 $user->setRegisterIp("10.13.212.2");
		 $this->doctrine->em->persist($user);
		 $this->doctrine->em->flush();
		 log_message("info","User {$user->getUsername()} created.");
		 print "User {$user->getUsername()} created.<br/><br/><br/>";
	}

}