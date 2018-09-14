<?php
class Users_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_users()
  {
  //  if ($slug === FALSE)
    //{
      $query = $this->db->get('users');
      return $query->result_array();
    //}

    //$query = $this->db->get_where('users', array('slug' => $slug));
    //return $query->row_array();
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

  public function login($data) {
    //$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
    $condition = "email =" . "'" . $data['email'] . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
      $row = $query->row();
      if(password_verify($data['password'], $row->password)){
        return true;
      }else{
        return false;
      }
    } else {
      return false;
    }
  }


  public function read_user_information($email) {

    $condition = "email =" . "'" . $email . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
      return $query->result();
    } else {
      return false;
    }
  }

}
