<?php use models\constants\PlantationType;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use models\Plantation;

class Dashboard_Control extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/Dashboard_Control
	 *	- or -
	 * 		http://example.com/index.php/Dashboard_Control/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$templateData = array();
		$this->load->spark('codeigniter-payments/0.1.6/');
		$this->load->view('MasterView',$templateData);
	}

	public function pay(){
		$this->load->spark('codeigniter-payments/0.1.6/');
		if($this->input->post()){

			//configure the parameters for the payment request
			$paymentParameters = array(
							    'cc_type'       => 'foo',
							    'cc_number'     => 'foo',
							    'cc_exp'        => 'foo',
							    'first_name'    => 'foo',
							    'last_name'     => 'foo',
							    'street'        => 'foo',
							    'street2'       => 'foo',
							    'city'          => 'foo',
							    'state'         => 'foo',
							    'country'       => 'foo',
							    'postal_code'   => 'foo',
							    'amt'           => 'foo',
							    'currency_code' => 'USD'
			);

			//make the call
			$paymentResponse = $this->payments->payment_action('paypal_paymentspro', $paymentParameters);

			//print the response
			print_r($paymentResponse);
		}
	}


	public function authUser(){
		$jsonResponse = array();
                //TODO
		//check if user exists
		//if not create a user with provided username, password and fullName
		$username = $jsonRequest["username"];
		$userRepository = $this->doctrine->em->getRepository('models\User');
		$user = $userRepository->findByUsername($username);
		if(null==$user){
			$jsonResponse["success"] = false;
			$jsonResponse["data"] = "User doesn't exist.";
		}else{
			$jsonResponse["success"] = true;
			$jsonResponse["data"]="User already exists.";
		}

		echo json_encode($jsonResponse);
        }	       
/**
 *
 * json api for plantation request
 * @param json $jsonRequest
 * @throws Exception
 */
   public function request($jsonRequest){
   	  var_dump($_POST);
	  $jsonResponse = array();
	  if(null!=$jsonRequest){//TODO also check user session
	    try{
		 if(!array_key_exists("forestId",$jsonRequest)){
			throw new Exception("Forest Can't be blank.", "01");
		 }
		 if(!array_key_exists("treeId",$jsonRequest)){
		 	throw new Exception("Tree Can't be blank.", "01");
		 }

		 if(!array_key_exists("numberOfTrees",$jsonRequest)){
		 	throw new Exception("Number of Trees Can't be blank.", "01");
		 }

		 if(!array_key_exists("type",$jsonRequest)){
		 	throw new Exception("Type Can't be blank.", "01");
		 }

		 $forestId = $jsonRequest["forestId"];
		 $treeId = $jsonRequest["treeId"];
		 $quantity = $jsonRequest["numberOfTrees"];
		 $type     = $jsonRequest["type"];
		 $userId   = 1;//get it from session

         	     //TODO create plantation and holes for number of quantity
		 		 $plantation = new Plantation();
                 $plantation->setType($type);
		         if($type==PlantationType::GIFT){
		 				$plantationFor = $jsonRequest["plantationFor"];
	                    $plantation->setPlantationFor($plantationFor);
		 		 }
                 $plantation->setQuantity($quantity);
                 $plantation->setPlantationIp($_SERVER["REMOTE_ADDR"]);
                 $plantation->setStatus(PlantationStatus::PENDING);

                 $planter = $this->doctrine->em->find('models\User',$userId);
                 $plantation->setPlanter($planter);

                 $forest = $this->doctrine->em->find('models\Forest',$forestId);
                 $tree = $this->doctrine->em->find('models\Tree',$treeId);

                 $plantation->setSource("WEB");
                 $this->doctrine->em->persist($plantation);
                 $this->doctrine->em->flush();

                 $treeCode = substr($forest->getName(), 0, 3)."-".substr($tree->getName(), 0, 3);
                 for ($i=1; $i <= $plantation->getQuantity();$i++){
                             $holes = new PlantationHoles();
                             $holes->setTree($tree);
                             $holes->setTreeCode($treeCode."-".$i);
                             $holes->setPlantation($plantation);
                             $this->doctrine->em->persist($holes);
                             $this->doctrine->em->flush();
		         }//end of for

		         $jsonResponse["success"] = "true";
		         //accessing the id field after calling flush will always contain the ID of a newly "persisted" entity.
		         $jsonResponse["message"] = $plantation->getId();

	    }catch (Exception $ex){
				 $jsonResponse["success"] = "false";
		         $jsonResponse["message"] = $ex->getMessage();
	    }

	    echo json_encode($jsonResponse);
	  }//end of post
    }//end of request
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
