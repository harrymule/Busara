
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
class Api extends REST_Controller
{

       public function __construct() {
               parent::__construct();
               $this->load->model('UserModel', 'user');
           
      }    
       public function user_get(){

        $this->response('Harry');
        // exit;
        //    $r = $this->user->read();
        //    $this->response($r); 
       }


       public function user_put(){
           $id = $this->uri->segment(3);
           $data = array('username' => $this->input->get('username'),
           'password' => $this->input->get('password')
           );
            $r = $this->user->update($id,$data);
               $this->response($r); 
       }

       public function user_post(){
           $data = array('username' => $this->input->post('username'),
           'password' => $this->input->post('password')
           );
           $r = $this->user->insert($data);
           $this->response($r); 
       }
       public function user_delete(){
           $id = $this->uri->segment(3);
           $r = $this->user->delete($id);
           $this->response($r); 
       }


    }


    