<?php 


class smssModel extends CI_Model
{
    private $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'smss';
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
        $data['user'] = $this->users->my_id();
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
            return $check ? $this->get($condition['id']) : false;
        } else {
            return $this->add($data);
        }
    }

    function delete($id)
    {
        $pic = $this->get($id);
        if ($pic && file_exists($pic['file_path'])) {
            unlink($pic['file_path']);
            $this->db->where('id', $id);
            return $this->db->delete($this->table);
        } elseif ($pic) {
            $this->db->where('id', $id);
            return $this->db->delete($this->table);
        }

        $this->user->reset_pic($id);
    }

    function last()
    {
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->row_array();
    }
    function trancate()
    {
        $this->db->query("TRUNCATE `{$this->table}`");
    }

    function user($user_id)
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where($this->table, ['user' => $user_id])->result_array();
    }


    function me()
    {
        $user = $this->users->me();
        return $this->user($user['id']);
    }

    function send($id)
    {
        $sms = $this->get($id);

        if ($sms) {
            $output = false;
            $message = urlencode($sms['message']);
            $phone = $sms['phone'];//filter_var($sms['phone'], FILTER_VALIDATE_INT) ? $sms['phone'] : false;
            if ($phone && $message) {
                $url = "https://platform.clickatell.com/messages/http/send?apiKey=HXFnMVHiSSOpD1Azq5918g==&to=$phone&content=$message";
                // $url  ='https://www.google.com';
                // create curl resource 
                $ch = curl_init(); 

            // set url 
                curl_setopt($ch, CURLOPT_URL, $url); 

        //return the transfer as a string 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
                $output = curl_exec($ch); 

        // close curl resource to free up system resources 
                curl_close($ch);
            }

            $sms['status'] = $output ? 'sent' : 'pending';
            $this->edit($sms);
            return $output;

        }
        return false;
    }







}