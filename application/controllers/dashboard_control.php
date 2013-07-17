<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use models\Plantation

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

        public function request(){
		if($this->input->post()){
		 
		 $forestId = $this->input->post('forestId');
		 $treeId   = $this->input->post('treeId');
		 $quantity = $this->input->post('numberOfTrees');
		 $type     = $this->input->post('type');
		 $userId   = 1;

         	 //TODO create plantation and holes for number of quantity
		 $plantation = new Plantation();
                 $plantation->setPlantationFor($this->input->post('plantationFor'));
                 $plantation->setQuantity($quantity);
                 $plantation->setPlantationIp("192.168.2.1");
                 $plantation->setStatus(PlantationStatus::PENDING);
		 
                 $planter = $this->doctrine->em->find('models\User',$userId);
                 $plantation->setPlanter($planter);
		 
                 $forest = $this->doctrine->em->find('models\Forest',$forestId);
                 $tree = $this->doctrine->em->find('models\Tree',$treeId);
		 
                 $plantation->setSource("WEB");
                 $plantation->setType($type);
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


	      }//end of post
        }//end of request
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
