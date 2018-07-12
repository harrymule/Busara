<?php 

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
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

    function index()
    {
        $this->login();
    }

    function login()
    {
        $this->page(__METHOD__, []);
    }

    function login_post()
    {
        
            $check = $this->users->login($this->input->post());
            if ($check) {              
            redirect('Account');
        } else {
            redirect('');
        }
        print_pre($check, true); 
    }

    function forgot_password()
    {
        $this->page(__METHOD__, []);

    }

    function forgt_password_post()
    {
        // print_r($_POST);
        redirect(__class__ . '/login');
    }
    function create_account()
    {
        $this->page(__METHOD__, []);
    }
    function create_account_post()
    {
        $this->users->create_account($this->input->post());
        redirect(__class__ . '/login');
    }

    function logout()
    {   
        $this->users->unset_session();
        redirect(__class__ . '/login');
    }

    
    public function User_login_ApI(){
        
        header("Access-Control-Allow-Origin: *");
        header("Content-Type:application/json; charset=UTF-8");
        $data = json_decode(file_get_contents("php://input"), true);

        $ref =
            ["username" => "",
            "password" => ""];

        $missing = [];
      

        foreach ($ref as $key => $value) {
            if (!isset($data[$key])) {
                $missing[] = $key;
            }
        }
        
        if (count($missing) > 0) {
            echo json_encode(['missing fields' => $missing]);
            exit;
        }

        $_POST["session_id"] = session_id();
        $_POST["server_address"] = $_SERVER['REMOTE_ADDR'];
        $_POST["user_agent"] = $this->input->user_agent(); 
        $_POST["username"] = $data['username'];
        $_POST["password"] = $data['password'];
        // $data_input =  $this->input->post();       
        // print_pre($this->input->post(), true);  
        

        $user = $this->db->get_where("users", ['username' => $_POST["username"]])->row_array();
        if ($user && $user['password'] == $this->users->enc($data['password'])) {
            return $this->users->session($user);
        } else {
            return false;
        }

        print_pre($user, true);


        $check = $this->users->login($this->input->post());


        if ($check) {
            return $this->users->me();
        } else {
           echo "An Error Has Occured";
            // echo $check;
        }

        print_pre($check, true);

             

        echo $check ? '{"ResponseCode":"1", "ResponseDesc":"Success"}' : "Error on saving to database";
            $this->load->helper('file');

            $file = $_SERVER['DOCUMENT_ROOT']."assets/data/login.txt";

        // print_pre($file,true);

        if (! file_put_contents($file, json_encode($data) . "\n\n" . file_get_contents($file)))
        {echo 'Unable to write the file';}
        else{ echo 'File written!';}
          
            // ( ! write_file($file, json_encode($data) . '\n\n' . file_get_contents($file)))
        // file_put_contents($file, json_encode($data) . '\n\n' . file_get_contents($file));       
    }

}
