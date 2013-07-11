<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Custom Controller
 * @author prayag
 *
 */
class Custom_Controller extends CI_Controller{

	var $templateData = array();

	var $mainmenu = NULL;

	public function __construct(){
		parent::__construct();
		$this->load->library('CssCrush');

		$this->templateData['mainstyler'] = CssCrush::file( BASEPATH.'../asset/css/mainstyler_.css' );
		//$this->templateData['menustyler'] = CssCrush::file( BASEPATH.'../asset/css/menu.css' );
		//$this->templateData['printstyler'] = CssCrush::file( BASEPATH.'../asset/css/print.css' );

		$this->load->library('breadcrumb');
		$this->breadcrumb->append_crumb('Dashboard', site_url());

		$this->templateData['mainmenu'] = $this->mainmenu;

		//$this->templateData['_CONFIG']	= $this->_CONFIG;
		//$this->templateData['flashdata'] = $this->session->flashdata('feedback');

		$this->templateData['scripts'] = array();
		$this->templateData['stylesheets'] = array();

		//check for any critical messages
		$_critical_messages = $this->message->get('alert','critical');
		//var_dump($_critical_messages); die;
		if(count($_critical_messages) > 0 ){
// 			if((strtolower($this->router->class) != 'dashboard_controller'))
// 				redirect('dashboard');
// 			else
				$this->templateData['critical_alerts'] = $_critical_messages;
		}

		$_feedbacks = $this->message->get(FALSE,'feedback');
		if(count($_feedbacks) > 0){
			$this->templateData['feedback'] = $_feedbacks;
		}
	}
}