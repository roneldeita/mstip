<?php
class Chats_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_chats()
  {
    $this->db->order_by('id', 'desc')->limit(10);
    $query = $this->db->get('chats');
    return array_reverse($query->result_array());
  }

  public function load_chats($data)
  {
    $condition = "id <" . "'" . $data['last_id'] . "'";
    $this->db->select('*');
    $this->db->from('chats');
    $this->db->where($condition);
    $this->db->order_by('id', 'desc');
    $this->db->limit(5);
    $query = $this->db->get();
    return $query->result_array();
  }
  
  public function save_chat($data)
  {
    $condition = "email =" . "'" . $data['email'] . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      $row = $query->row();
      $data['student_id'] = $row->student_id;
      $data['display_name'] = $row->first_name.' '. $row->last_name;
      unset($data['email']);
      $this->db->insert('chats', $data);
      if ($this->db->affected_rows() > 0) {
        $inserted = $this->db->get_where('chats', array('id' => $this->db->insert_id()));
        return $inserted->row();
      }
    }
  }
  
}