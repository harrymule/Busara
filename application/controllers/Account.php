<?php 

class Account extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('usersModel', 'users');
        $this->load->model('picturesModel', 'pictures');
        $this->load->model('smssModel', 'smss');
        if (!$this->users->check_login()) {
            redirect('Login');
        }
    }

    private function page($method, $passData = [])
    {
        $data['me'] = $this->users->me();
        $file_array = explode('::', $method);
        $filename = '';
        foreach ($file_array as $value) {
            $filename .= ucwords($value) . '/';
        }
        $filename = substr($filename, 0, (strlen($filename) - 1));

        $this->load->view('Includes/header', []);
        $this->load->view('Includes/nav', $data);
        $this->load->view('Includes/aside', ['data' => $data]);
        $this->load->view($filename, ['data' => $passData]);
        $this->load->view('Includes/end_aside');

        $this->load->view('Includes/footer', []);
    }

    function index()
    {
        $this->my_account();
    }

    function my_account()
    {
        $data['pictures'] = $this->pictures->me();
        $data['me'] = $this->users->me();
        $this->page(__METHOD__, $data);
    }

    function pictures()
    {    
        return $this->my_account();
    }
    function smss()
    {
        $data['me'] = $this->users->me();
        $data['smss'] = $this->smss->me();
        $this->page(__METHOD__, $data);
    }

    function save_message()
    {
        $this->smss->add($this->input->post());
        redirect(__class__ . '/smss');
    }

    function send_message($id)
    {
        $this->smss->send($id);
        redirect(__class__ . '/smss');
    }


    function delete_message($id)
    {
        $this->smss->delete($id);
        redirect(__class__ . '/smss');
    }


    function delete_picture($id)
    {
        $this->pictures->delete($id);
        redirect(__class__ . '/my_account');
    }

    function settings_post()
    {
        $this->users->edit($this->input->post());
        redirect(__class__ . '/my_account');
    }

    function upload_images()
    {
        $this->pictures->upload($_FILES);
        redirect(__class__ . '/my_account');
    }

    function set_as_profile_pic($pictures_id)
    {
        $me = $this->users->me();
        $pic = $this->pictures->get($pictures_id);
        if ($pic && file_exists($pic['file_path'])) {
            $data = [
                'id' => $me['id'],
                'profile_pic' => $pic['id']
            ];
            $this->users->edit($data);
        }
        redirect(__class__ . '/my_account');
    }

    public function users($user = 0)
    {
        $data['users'] = $this->users->all();
        // foreach ($data['users'] as $key => $value) {
        //     $data['users']['key'] = $this->users->user($value['id']);
            
                
        // }
        
        // print_pre($data['users']['key']);       
        // exit;

        $data['user'] = $this->users->user($user);
        $data['user'] = $data['user'] ? $data['user'] : $data['users'][0];
        $data['user']['pictures'] = $this->pictures->user($data['user']['id']);
        $this->page(__METHOD__, $data);
    }





}
