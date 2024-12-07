<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_user_data()
    {
        return $this->db->get('users')->result();
    }

}
