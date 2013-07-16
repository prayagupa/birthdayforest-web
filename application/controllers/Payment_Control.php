<?php use models\constants\PlantationStatus;
use models\constants\Gateway;
use models\constants\TransactionStatus;
use models\Transaction;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_Control extends CI_Controller {

	private $plantationRepository;


	function __construct(){
		parent::__construct();
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


	public function esewasuccess(){
		//TODO
		//$plantation update with the plantationCode
		//processPayment and update $plantation status from PENDING to REQUESTED
		//notify that user(email, sms)
		$orderId = $this->input->get('oid');
        $amount  = $this->input->get('amt');
        $refId   = $this->input->get('refId');
        $plantationRepository= $this->doctrine->em->getRepository('models\Plantation');
		$plantation = $plantationRepository->getJustPaidPlantationById($orderId);
		if(null!=$plantation){
			$transaction = new Transaction();
			$transaction->setAmount($amount);
			$transaction->setGatewayTransactionId($refId);
			$transaction->setStatus(TransactionStatus::PAID);
			$transaction->setGateway(Gateway::ESEWA);

			//FIXME
			//IPN
			//holes
			$plantation = $this->doctrine->em->find('models\Plantation',$orderId);
			$plantation->setStatus(PlantationStatus::REQUESTED);
			$plantation->setTransaction($transaction);
			$this->doctrine->em->persist($plantation);
			$this->doctrine->em->flush();
			print "Thanks, your request has been sent.";
		}else{
			$templateData = array();
			$this->load->view('MasterView',$templateData);
		}
	}

	public function esewafailure(){

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
