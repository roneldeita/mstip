<?php
class Jobs_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_jobs()
  {
    $query = $this->db->get('jobs');
    return $query->result_array();
  }
  
}
