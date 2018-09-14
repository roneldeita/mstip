<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //load url helper
    $this->load->helper('url');
    // Load session library
    $this->load->library('session');
    // Load database
    $this->load->model('jobs_model');
  }

  public function index($slug = NULL)
  {
    $data['title'] = 'Find Jobs';
    $data['jobs'] = $this->jobs_model->get_jobs();
    if(isset($this->session->userdata['logged_in'])){
      if($this->session->userdata['logged_in']['status'] == 1){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/secure-menu', $data);
        $this->load->view('jobs/index', $data);
        $this->load->view('templates/footer');
      }else{
        redirect('secure/pending');
      }
    }else{
      redirect('auth/logout', 'refresh');
    }
  }
}
