<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_Control extends CI_Controller {

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
		//$plantation = $plantationRepository->getByPlantationCode($plantationCode);
		//$transaction = processTransaction($plantationCode, $amount);
	}

	public function esewafailure(){
			                
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
