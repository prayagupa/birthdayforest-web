<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Message:: a library for giving feedback to the user
 *
 * @author  Adam Jackett
 * @url http://www.darkhousemedia.com/
 * @version 2.1
 */

class CI_Message {

    var $CI;
    var $messages = array();
    var $wrapper = array('', '');

    function CI_Message($config = NULL){
        $this->CI =& get_instance();
        //$this->CI->load->library('session');

        //if($this->CI->session->flashdata('_messages'))
        	//$this->messages = $this->CI->session->flashdata('_messages');
        if(isset($config['wrapper'])) $this->wrapper = $config['wrapper'];
    }

    function set($message, $type, $flash=FALSE, $group=FALSE){
        if(!is_array($message)) $message = array($message);
        foreach($message as $msg){
            $obj = new stdClass();
            $obj->message = $msg;
            $obj->type = $type;
            $obj->flash = $flash;
            $obj->group = $group;
            $this->messages[] = $obj;
        }

        $flash_messages = array();
        foreach($this->messages as $msg){
            if($msg->flash) $flash_messages[] = $msg;
        }
        //if(count($flash_messages)) $this->CI->session->set_flashdata('_messages', $flash_messages);
    }

    function get($type = FALSE, $group = FALSE){

    	$output = array();
        if(count($this->messages)){
            foreach($this->messages as $msg){

            	if($type !== FALSE && $group !== FALSE){
            		if($msg->type == $type && $msg->group == $group)
            			$output[] = $msg->message;
            	}else if($type !== FALSE && $group == FALSE){
            		if($msg->type == $type){
            			$output[] = $msg->message;
            		}
            	}else if($type == FALSE && $group !== FALSE){
            		if($msg->group == $group){
            			if(!isset($output[$msg->type]))
            				$output[$msg->type] = array();
            			$output[$msg->type][] = $msg->message;
            		}
            	}else{
            		if(!isset($output[$msg->group]))
            			$output[$msg->group] = array();

            		if(!isset($output[$msg->group][$msg->type]))
            			$output[$msg->group][$msg->type] = array();

            		$output[$msg->group][$msg->type][] = $msg->message;
            	}

            }
        }

        return $output;
    }

}