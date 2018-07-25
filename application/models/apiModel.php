
<?php 


class apiModel extends CI_Model
{
    private $table;

    var $client_service = "frontend-client";
    var $auth_key       = "ApiBusara";

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->load->model('fileModel', 'file');
    }

    

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return jsonOutput(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $user  = $this->db->select('expired_at')->from('users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
        if($user == ""){
            return jsonOutput(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($user ->expired_at < date('Y-m-d H:i:s')){
                return jsonOutput(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('users_id',$users_id)->where('token',$token)->update('users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }

    function enc($string) // array [username => ,password => ]
    {
        return md5('oiai4y' . $string . 'u983uF');
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
        return $check ? array('status' => 201,'message' => 'user created Successfully.', 'data' => $this->last()) : false;
    }

    function edit($data)
    {
        if (isset($data['id']) && $data['id'] && $this->get($data['id'])) {
            $condition = ['id' => $data['id']];
            unset($data['id']);
            $this->db->where($condition);
            $check = $this->db->update($this->table, $data);
            return $check ? $this->get($condition['id']) : false;
        } else {
            return $this->add($data);
        }
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);

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
        if($user == ""){
            $output = array('status' => 204,'message' => 'Username not found.');               
            return $output;
        } else {
            $hashed_password = $user['password'];
            $id              = $user['id'];
            
            if ($user && $user['password'] == $this->enc($data['password'])) {
                $last_login = date('Y-m-d H:i:s');
            // preferred to generate random character than password hashing but find below password hashing code:
            //    $token = password_hash(substr( md5(rand()), 0, 7), PASSWORD_BCRYPT, ['password'=>$hashed_password]);
                $token = $this->getToken(36);
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours')); 
                $this->db->trans_start();
                $this->db->where('id',$id)->update('users',array('last_login' => $last_login));
                $this->db->insert('users_authentication',array('users_id' => $id,'token' => $token,'expired_at' => $expired_at));
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    return array('status' => 500,'message' => 'Internal server error.');
                } else {
                    $this->db->trans_commit();
                    return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'token' => $token);
                }
            } else {
                echo "Wrong password";
                exit();
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $this->db->where('users_id',$users_id)->where('token',$token)->delete('users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }

    function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";

        $max = strlen($codeAlphabet); 
   
       for ($i=0; $i < $length; $i++) {
           $token .= $codeAlphabet[random_int(0, $max-1)];
       }
   
       return $token;
   }

    function check_login()
    {
        return $this->session->user ? true : false;
    }

    function forgot_password($data) // array [username => ,password => ]
    {

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