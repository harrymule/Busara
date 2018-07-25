<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('apiModel', 'api');  
        $this->load->model('usersModel', 'users');  

    }

    private function page($method, $data = [])
    {
        $file_array = explode('::', $method);
        $filename = '';
        foreach ($file_array as $value) {
            $filename .= ucwords($value) . '/';
        }
        $filename = substr($filename, 0, (strlen($filename) - 1));

        $this->load->view('Includes/header', []);
        $this->load->view($filename, []);
        $this->load->view('Includes/footer', []);
    }

    function login()    {
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();			
			if($check_auth_client == true){
				$params = $_REQUEST;		        
		        $data['username'] = $params['username'];
                $data['password'] = $params['password'];                		        	
                $response = $this->api->login($data);                              
                header('Content-type: application/json');
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);            
            }            
        }
    }

    function forgot_password(){$this->page(__METHOD__, []);}

    function forgt_password_post(){redirect(__class__ . '/login');}

    function create_account(){ $this->page(__METHOD__, []);}

    function create_account_post(){ $this->api->create_account($this->input->post());redirect(__class__ . '/login'); }

    function logout()
    {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->api->logout();
                header('Content-type: application/json');
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);   
			}
		}
    }
    
    function getUser($id){

        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->api->auth();
		        if($response['status'] == 200){
                    $resp = $this->users->user($id);                   
                    if($resp['password'] != ""){
                        unset($resp['password']);
                    }
					jsonOutput($response['status'],$resp);
		        }
			}
		}
    }

    function getUsers(){
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->api->auth();
		        if($response['status'] == 200){
                    $resp = $this->users->getAllUsers(); 
                    foreach ($resp as &$value) {
                        unset($value['password']);
                    }
                    unset($value);                    
					jsonOutput($response['status'],$resp);
		        }
			}
		}
    }

    function createUser(){
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->api->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
                    $data = json_decode(file_get_contents('php://input'), TRUE);  
					if ($data['username'] == "" &&  $data['password'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'username & password can\'t empty');
					} else {
                        $resp = $this->users->create_account($data);
                        if($resp['password'] != ""){
                            unset($resp['password']);
                        }
					}
					jsonOutput($respStatus,$resp);
		        }
			}
		}
    }

    function updateUser($id){

        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->api->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
                    $data = json_decode(file_get_contents('php://input'), TRUE);
                    $data['modified'] = date('Y-m-d H:i:s');
                    $resp = $this->users->edit($data);					
					jsonOutput($respStatus,$resp);
		        }
			}
		}
        
    }

    function deleteUser($id){

        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->api->auth();
		        if($response['status'] == 200){
		        	$resp = $this->users->delete($id);
					jsonOutput($response['status'],$resp);
		        }
			}
		}
    }

    function registerUser(){
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			jsonOutput(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->api->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->api->auth();
		        $respStatus = $response['status'];
		        if($response['status'] == 200){
                    $data = json_decode(file_get_contents('php://input'), TRUE);  
					if ($data['username'] == "" &&  $data['password'] == "") {
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'username & password can\'t empty');
					} else {
                        $resp = $this->users->create_account($data);
                        if($resp['password'] != ""){
                            unset($resp['password']);
                        }
					}
					jsonOutput($respStatus,$resp);
		        }
			}
		}

    }

}
