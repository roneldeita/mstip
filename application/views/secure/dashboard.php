<?php
  if (isset($this->session->userdata['logged_in'])) {
    $studentid = ($this->session->userdata['logged_in']['student_id']);
    $email = ($this->session->userdata['logged_in']['email']);
    $firstname = ($this->session->userdata['logged_in']['first_name']);
    $lastname = ($this->session->userdata['logged_in']['last_name']);
  }
?>
<div class="dashboard">
  <div class="row justify-content-md-center">
    <div class="col-md-11">
      <h6>Welcome, <b><?php echo $firstname . " ". $lastname ?></b><h6>
      <hr/>
    </div>
    <div class="col-md-11">
      </br>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-center">
              <span class="fa fa-user-circle"></span>
              <hr/>
              <p>lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
              <button class="btn">View my profile</button>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-center">
              <span class="fa fa-comments"></span>
              <hr/>
              <p>lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
              <button class="btn">Continue to chat</button>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-center">
              <span class="fa fa-briefcase"></span>
              <hr/>
              <p>lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
              <button class="btn">Find a job</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
