<?php defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();

class Secure extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //load url helper
    $this->load->helper('url');
    // Load session library
    $this->load->library('session');
    // Load database
    $this->load->model('users_model');

  }
  public function pending(){
    $data['title'] = ucfirst('pending');
    if(isset($this->session->userdata['logged_in'])){
      if($this->session->userdata['logged_in']['status'] == 0){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/secure-menu');
        $this->load->view('secure/pending');
        $this->load->view('templates/footer');
      }else{
        redirect('secure/dashboard');
      }
    }else{
      redirect('auth/logout', 'refresh');
    }
  }
  // Show dashboard page
  public function dashboard(){
    $data['title'] = ucfirst('dashboard');
    if(isset($this->session->userdata['logged_in'])){
      if($this->session->userdata['logged_in']['status'] == 1){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/secure-menu');
        $this->load->view('secure/dashboard');
        $this->load->view('templates/footer');
      }else{
        redirect('secure/pending');
      }
    }else{
      redirect('auth/logout', 'refresh');
    }
  }
}

?>
