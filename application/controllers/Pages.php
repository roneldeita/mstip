<?php

class Pages extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    // Load session library
    $this->load->library('session');
    // Load form helper library
    $this->load->helper('form');
    //Load form validation library
    $this->load->library('form_validation');
    //load url helper
    $this->load->helper('url_helper');
    //model
    $this->load->model('users_model');
  }

  public function view($page = 'home')
  {
    if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
    {
            // Whoops, we don't have a page for that!
            show_404();
    }

    $data['title'] = ucfirst($page); // Capitalize the first letter

    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer', $data);
  }
}