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
		$orderId = $this->input->get('oid');
        $amount  = $this->input->get('amt');
        $refId   = $this->input->get('refId');

        $plantationRepository= $this->doctrine->em->getRepository('models\Plantation');
		$plantation = $plantationRepository->getJustPaidPlantationById($orderId);
		if(null!=$plantation){
			//processPayment and update $plantation status from PENDING to REQUESTED
			$transaction = new Transaction();
			$transaction->setAmount($amount);
			$transaction->setGatewayTransactionId($refId);
			$transaction->setStatus(TransactionStatus::PAID);
			$transaction->setGateway(Gateway::ESEWA);

			//FIXME
			//IPN
			//holes
			//$plantation update with the plantationCode
			$plantation = $this->doctrine->em->find('models\Plantation',$orderId);
			$plantation->setStatus(PlantationStatus::REQUESTED);
			$plantation->setTransaction($transaction);
			$this->doctrine->em->persist($plantation);
			$this->doctrine->em->flush();

			//notify that user(email, sms)
			//send Email
			$mailTemplate = <<<EOT
			<h3 style="color: #228D06">Thank You for Planting Tree with us. Now you are the part of Green Celebration!</h3>
					<p>Dear {$plantation->getPlanter()->getUsername()},<br><br>
					This email has been sent as a confirmation to your request for the plantation of {$plantation->getQuantity()} {$treeName} tree(s) at {$forest}. We are very happy to process your request and you will be confirmed of the plantation of tree with a picture of the tree along with your name tag. The status of the tree will be updated to you in every 6 months for the period of three years. For more information, please read our terms and conditions <a href="#">here.</a><br><br>
					You can view your invoice at <a href="#"></a>
					</p>
					<p style="font-size: 12px;"><strong>Important Notice!</strong><br><br>
					If you are not the right recipient of this email, <b>Please delete this email immediately!</b>. Misuse of the information in the email is subject to violation of law.</p>
EOT;
            $this->load->library("email");
            $config = array('mailtype' => 'html');
            $this->email->initialize($config);
            $this->email->from("dev@birthdayforest.org","Birthday Forest");
            $this->email->to($plantation->getPlanter()->getEmail());
            $this->email->subject("{Plantation Request Received");
            $msg = <<<EOT
					<html>
					<head>
					<title>Birthday Forest Email</title>
					</head>
					<body>
					<div>
					<div>
					<img src="<?=base_url(); ?>static/images/logo.jpg">
					</div>
					<div style="margin: 20px;">
            			{$mailTemplate}
					</div>
					</div>
					</body>
					</html>
EOT;

            $this->email->message($msg);
            $this->email->send();

			print "Thank You for Planting Tree with us. Now you are the part of Green Celebration!";
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
