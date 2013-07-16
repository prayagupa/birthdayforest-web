<?php
/**
 *@author Prayag
 */

use models\Stock;
use models\PlantationHoles;
use models\constants\PlantationType;
use models\constants\PlantationStatus;
use Doctrine\DBAL\Schema\Schema;

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
 * http://example.com/index.php/Migration_Control
 * @author prayag
 *
 */
class Migration_Control extends CI_Controller{
	var $schemas;
	private $userRepository;

	public function __construct(){
		parent::__construct();
		$this->schemas = array(	$this->doctrine->em->getClassMetadata('models\Address')
								,$this->doctrine->em->getClassMetadata('models\Plantation')
								,$this->doctrine->em->getClassMetadata('models\Transaction')
								,$this->doctrine->em->getClassMetadata('models\PlantationHoles')
								,$this->doctrine->em->getClassMetadata('models\User')
								,$this->doctrine->em->getClassMetadata('models\Forest')
								,$this->doctrine->em->getClassMetadata('models\Tree')
								,$this->doctrine->em->getClassMetadata('models\Stock')
								,$this->doctrine->em->getClassMetadata('models\StockTrees')
								,$this->doctrine->em->getClassMetadata('models\Hole')
						);
	  $userRepository = $this->doctrine->em->getRepository('models\User');
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
		$this->createForest();
		$this->createTree();

		$this->createStock();
		$this->createPlantation();
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


	/**
	 *
	 * create a forest
	 */
	public function createForest(){
		 $user = new Forest();
		 $user->setName("Gaukhureshwor Community Forest");
		 $user->setAddress("Kavre");
		 $user->setActive(TRUE);
		 $user->setImage("Gaukhureshwor.jpg");
		 $this->doctrine->em->persist($user);
		 $this->doctrine->em->flush();
		 log_message("info","Forest {$user->getName()} created.");
		 print "Forest {$user->getName()} created.<br/><br/><br/>";
	}

	/**
	 *
	 * create a stock
	 */
	public function createStock(){
		 $user = new Stock();
		 $user->setStockNumber(10);
		 $forest = $this->doctrine->em->find('models\Forest',1);
		 $user->setForest($forest);
		 $user->setStartDate(new DateTime());
		 $user->setAvailable(TRUE);
		 $this->doctrine->em->persist($user);
		 $this->doctrine->em->flush();
		 log_message("info","Stock for {$user->getForest()->getName()} created.");
		 print "Stock for {$user->getForest()->getName()} created.<br/><br/><br/>";
	}

	/**
	 *
	 * create a tree
	 */
	public function createTree(){
		 $user = new Tree();
		 $user->setName("Kalki");
		 $user->setLocalName("Kalki");
		 $user->setScientificName("Kalki");
		 $user->setLifespan(2);
		 $user->setImage("kalki.jpg");
		 $user->setDescription("Kalki");
		 $this->doctrine->em->persist($user);
		 $this->doctrine->em->flush();
		 log_message("info","Tree {$user->getName()} created.");
		 print "Tree {$user->getName()} created.<br/><br/><br/>";
	}

	/**
	 *
	 * create a plantation
	 */
	public function createPlantation(){

		 $forestId = 1;
		 $quantity = 1;
		 //TODO check stock available for $forestId else throw Exception
		 $plantation = new Plantation();
		 $plantation->setPlantationFor("PRAYAG");
		 $plantation->setQuantity($quantity);
		 $plantation->setPlantationIp("192.168.2.1");
		 $plantation->setStatus(PlantationStatus::PENDING);

		 $planter = $this->doctrine->em->find('models\User',1);
		 $plantation->setUser($planter);

		 $forest = $this->doctrine->em->find('models\Forest',$forestId);
		 $tree = $this->doctrine->em->find('models\Tree',1);


		 $plantation->setSource("WEB");
		 $plantation->setType(PlantationType::SELF);
		 $this->doctrine->em->persist($plantation);
		 $this->doctrine->em->flush();

	     for ($i=1; $i <= $plantation->getQuantity();$i++){
			 $holes = new PlantationHoles();
			 $holes->setTree($tree);
			 $holes->setTreeCode("KAV-GAU-00".$i);
			 $holes->setPlantation($plantation);
			 $this->doctrine->em->persist($holes);
			 $this->doctrine->em->flush();
		 }

		 log_message("info","Plantation id {$plantation->getId()} created.");
		 print "Plantation {$plantation->getId()} created.<br/><br/><br/>";
	}

}
