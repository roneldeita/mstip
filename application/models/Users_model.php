<?php
class Users_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_users($slug = FALSE)
  {
    if ($slug === FALSE)
    {
      $query = $this->db->get('users');
      return $query->result_array();
    }

    $query = $this->db->get_where('users', array('slug' => $slug));
    return $query->row_array();
  }

  // Insert registration data in database
  public function registration_insert($data) {

    // Query to check whether email already exist or not
    $condition = "email =" . "'" . $data['email'] . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
  
    // Query to insert data in database
    $this->db->insert('users', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    }
    } else {
      return false;
    }
  }
  

}

