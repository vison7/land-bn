<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Keys {

    private $_CI;

    public function __construct() {
        // Get the CodeIgniter reference
        //$this->_CI = &get_instance();
    }

    static function verify_token() {
        $k = &get_instance();
		$token = (isset($_REQUEST['token'])) ? $_REQUEST['token'] : '';
        if (in_array($token, $k->config->item('api_token'))) {
            
        } else {
            $k->response([
                'code' => 401,
                'status' => FALSE,
                'message' => 'Invalid token '. $token .'='. $k->config->item('api_token')
                    ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    static function check($token) {
        $k = &get_instance();
		//print_r($k->input->get_request_header);
		//$token = $k->input->get_request_header('X-Auth');

        if (in_array($token, $k->config->item('api_token'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
