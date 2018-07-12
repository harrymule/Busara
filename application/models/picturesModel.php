<?php 

class picturesModel extends CI_Model
{
    private $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'pictures';
        $this->load->model('fileModel', 'file');
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
            return $check ? $this->get($condition['id']) : false;
        } else {
            return $this->add($data);
        }
    }

    function delete($id)
    {
        $pic = $this->get($id);
        if ($pic && file_exists($pic['file_path'])) {
            $json = json_encode($pic);
            $this->file::delete($pic['filename'], $json);
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

    function user($user_id)
    {
        $this->db->order_by('id', 'DESC');
        $array = $this->db->get_where($this->table, ['user' => $user_id])->result_array();
        $pictures = [];
        // echo '<pre>';
        foreach ($array as $value) {

            if (file_exists($value['file_path'])) {
                $value['thumbnail'] = base_url($this->file::crop($value['filename'],300,300));
                $pictures[] = $value;
            } else {
                $this->delete($value['id']);
            }
        }
        return $pictures;
    }

    function trancate()
    {
        $this->db->query("TRUNCATE `{$this->table}`");
    }

    function me()
    {
        $user = $this->users->me();
        return $this->user($user['id']);
    }

    function upload($files_array)
    {
        $files = $files_array['pictures'];
        $me = $this->users->me();
        $record['user'] = $me['id'];
        $data = [];
     
        // print_r($files);
        foreach ($files['error'] as $key => $value) {
            $type = strpos($value['type'][$key], 'image') !== false;
            if ($value === 0) {
                $record['filename'] = $this->file::upload($files['tmp_name'][$key], $files['name'][$key]);
                $record['filename'] = $this->file::toJpeg($record['filename']);
                $record['file_path'] = 'assets/uploads/' . $record['filename'];
                $record['file_path'] = 'assets/uploads/' . $record['filename'];
                $record['title'] = $files['name'][$key];
                $record['file_link'] = base_url($record['file_path']);
                if ($record['filename']) {
                    $data[] = $this->add($record);
                }
            }
        }
        return $data;
    }








}