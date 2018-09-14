<?php
  if (isset($this->session->userdata['logged_in'])) {
    header("location: http://localhost/mstip/index.php/secure/dashboard");
  }
?>
<div class="login">
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <?php
            if (isset($success_message)) {
              echo "<div class='text-success'>";
              echo '<p>'.$success_message.'</p>';
              echo "</div>";
            }
          ?>
          <?php
            echo "<div class='text-danger'>";
            if (isset($error_message)) {
              echo '<p>'.$error_message.'</p>';
            }
            echo validation_errors();
            echo "</div>";
          ?>
          <?php
            echo form_open('auth/handle_user_login');

            echo '<div class="form-group">';
            echo form_label('Email', 'email');
            $user_email = array(
              'type' => 'email',
              'name' => 'email',
              'value' => set_value('email'),
              'class' => 'form-control'
            );
            echo form_input($user_email);
            echo '</div>';

            echo '<div class="form-group">';
            echo form_label('Password', 'password');
            $user_password = array(
              'type' => 'password',
              'name' => 'password',
              'class' => 'form-control'
            );
            echo form_password($user_password);
            echo '</div>';

            echo form_submit('submit', 'Login', ['class'=>'btn']);
            echo form_close();
            echo '<br/>';
            echo anchor(base_url('auth/register'), 'To sign up click here');
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <h3>Lorem ipsum dolor</h3>
      <hr/>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
        when an unknown printer took a galley of type and scrambled it to make a type
        specimen book. It has survived not only five centuries, but also the leap into
        electronic typesetting, remaining essentially unchanged. It was popularised in
        the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
        and more recently with desktop publishing software like Aldus PageMaker including
        versions of Lorem Ipsum.</p>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
        when an unknown printer took a galley of type and scrambled it to make a type
        specimen book.</p>
    </div>
  </div>
</div>
