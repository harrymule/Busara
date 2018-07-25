<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model

{
    private $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
       
    }

    public function read(){
        $query = $this->db->query("select * from `{$this->table}` }");
        return $query->result_array();
    }



    public function insert($data){
        $this->user_name = $data['username']; // please read the below note
        $this->user_password = $data['password'];
        if($this->db->insert($this->table , $this))
        {    
            return 'Data is inserted successfully';
        }
            else
        {
            return 'Error has occured';
        }
    }



    public function update($id,$data){
            $this->user_name    = $data['username']; // please read the below note
            $this->user_password  = $data['password'];
                $result = $this->db->update($this->table, $this,array('user_id' => $id));

                if($result)
                {
                    return "Data is updated successfully";
                }
                else
                {
                    return 'Error has occurred';
                }

    }



    public function delete($id){
        $result = $this->db->query("delete from `{$this->table}` where user_id = $id");
        if($result)
        {
            return "Data is deleted successfully";
        }
        else
        {
            return "Error has occurred";
        }
    }
}



