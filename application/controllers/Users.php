<?php
class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('users_model');
    $this->load->helper('url_helper');
  }

  public function index($slug = NULL)
  {
    $data['title'] = 'Users archive';
    $data['users'] = $this->users_model->get_users();
    $data['users_item'] = $this->users_model->get_users($slug);

    $this->load->view('templates/header', $data);
    $this->load->view('users/index', $data);
    $this->load->view('templates/footer');
  }

  public function view($slug = NULL)
  {
    $data['title'] = 'Users archive';
    $data['users'] = $this->users_model->get_users();
    $data['users_item'] = $this->users_model->get_users($slug);

    $this->load->view('templates/header', $data);
    $this->load->view('users/index', $data);
    $this->load->view('templates/footer');
  }
}