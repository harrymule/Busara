<?php 


class usersModel extends CI_Model
{
    private $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->load->model('fileModel', 'file');
        $this->load->model('picturesModel', 'pictures');
    }

    function all()
    {
        return $this->db->get($this->table)->result_array();
    }

    function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    function add($data)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }
        $check = $this->db->insert($this->table, $data);
        return $check ? $this->last() : false;
    }

    function edit($data)
    {
        if (isset($data['id']) && $data['id'] && $this->get($data['id'])) {
            $condition = ['id' => $data['id']];
            unset($data['id']);
            $this->db->where($condition);
            $check = $this->db->update($this->table, $data);
            return $check ? array('status' => 200,'message' => 'User Details updated Successfully.' ,'data' => $this->get($condition['id'])) : false;
        } else {
            return $this->add($data);
        }
    }


    function delete($id)
    {
        $this->db->where('id', $id);
        $check = $this->db->delete($this->table);
        return  $check ? array('status' => 200,'message' => 'User has been deleted.' ) : array('status' => 400,'message' => 'User NOT deleted.' ) ;
    }

    function last()
    {
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->row_array();
    }

    function create_account($data) // array [username => ,password => ]
    {
        $data['password'] = $this->enc($data['password']);
        return $this->add($data);
    }

    function login($data) // array [username => ,password => ]
    {
        $user = $this->db->get_where($this->table, ['username' => $data['username']])->row_array();

        if ($user && $user['password'] == $this->enc($data['password'])) {
            return $this->session($user);
        } else {
            return false;
        }
    }

    function check_login()
    {
        return $this->session->user ? true : false;
    }

    function forgot_password($data) // array [username => ,password => ]
    {

    }

    function enc($string) // array [username => ,password => ]
    {
        return md5('oiai4y' . $string . 'u983uF');
    }

    function session($data) // array [username => ,password => ]
    {
        $this->session->user = $data;

        return true;
    }
    function unset_session()
    {
        $this->session->user = false;
    }

    function user($user_id)
    {
        $user = $this->get($user_id);
        //this function is not allowed to return password field or any other sensitive field
        // if($user['password'] != ""){
        //     unset($user['password']);
        // }
        if (!$user) {
            return false;
        }
        $pic = $this->pictures->get($user['profile_pic']);
        if ($pic) {
            $user['profile_pic'] = base_url($this->file::thumbnail($pic['filename']));// $pic['file_link'];
        } else {
            $user['profile_pic'] = base_url('assets/uploads/user.jpg');
        }
        return $user;
    }

    function getAllUsers() {
        $me = $this->me();
        $this->db->order_by("id", "DESC");
        $users = $this->db->get($this->table)->result_array();
        //if the users table has a user type field we filter 
        // foreach ($users as $key => $user) {
        //     $user_type = $this->user_type->get($user['user_type']);
        //     foreach ($user_type as $label => $value) {
        //         $users[$key]["user_type_" . $label] = $value;
        //     }
        // }
        return $users;
    }

    function reset_pic($id)
    {
        $this->db->where(['profile_pic' => $id]);
        $this->db->update($this->table, ['profile_pic' => 0]);
    }

    function me()
    {
        $user = $this->session->user;
        return $this->user($user['id']);
    }

    function my_id()
    {
        $user = $this->me();
        return $user['id'];
    }



















}