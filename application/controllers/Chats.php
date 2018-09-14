<?php defined('BASEPATH') OR exit('No direct script access allowed');
require __DIR__ . '../../vendor/autoload.php';

class Chats extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    //load url helper
    $this->load->helper('url');
    // Load session library
		$this->load->library('session');
    // Load database
    $this->load->model('chats_model');
	}
	
	public function index($slug = NULL)
  {
    $data['title'] = 'General Chat';
    $data['chats'] = $this->chats_model->get_chats();
    if(isset($this->session->userdata['logged_in'])){
      if($this->session->userdata['logged_in']['status'] == 1){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/secure-menu', $data);
        $this->load->view('chat/index', $data);
        $this->load->view('templates/footer');
      }else{
        redirect('secure/pending');
      }
    }else{
      redirect('auth/logout', 'refresh');
    }
	}

	public function send_message(){
		$data = array(
			'message' => html_escape($this->input->post('message', TRUE)),
			'email' => $this->session->userdata['logged_in']['email']
    );
		$result = $this->chats_model->save_chat($data);
	//	if ($result == TRUE) {
			//pusher
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
			'd3d2293f6af467fee07c',
			'bd8db33f1a3b31a36828',
			'594445',
			$options
		);
		$event = $pusher->trigger('my-channel', 'my-event', json_encode($result));
		//}
	}

	public function load_message(){
		$data = array(
			'last_id' => html_escape($this->input->get('last_id', TRUE))
		);
		$result['chats'] = $this->chats_model->load_chats($data);
		echo json_encode($result);
	}

	public function trigger_event()
	{
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		$options = array(
	    'cluster' => 'ap1',
	    'useTLS' => true
	  );
	  $pusher = new Pusher\Pusher(
	    'd3d2293f6af467fee07c',
	    'bd8db33f1a3b31a36828',
	    '594445',
	    $options
	  );

	  $data['message'] = 'hello world';
	  $event = $pusher->trigger('my-channel', 'my-event', $data);

		if ($event === TRUE)
		{
			echo 'Event triggered successfully!';
		}
		else
		{
			echo 'Ouch, something happend. Could not trigger event.';
		}
	}
}
