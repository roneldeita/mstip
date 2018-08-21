<!-- <html>
  <head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
  </head>
  <body> -->
<?php
  if (isset($this->session->userdata['logged_in'])) {
    header("location: http://localhost/mstip/index.php/auth/login");
  }
?>
<div id="main">
  <div id="login">
    <h2>Registration Form</h2>
    <hr/>
    <?php
      echo "<div class='error_msg'>";
      echo validation_errors();
      echo "<div class='error_msg'>";
      if (isset($message_display)) {
        echo $message_display;
      }
      echo"<br/>";
      echo "</div>";
      echo form_open('auth/new_user_registration');

      echo form_label('Student ID:');
      echo"<br/>";
      $student_id = array(
        'type' => 'text',
        'name' => 'student_id',
        'value' => set_value('student_id')
      );
      echo form_input($student_id);
      echo "</div>";
      echo form_label('Email : ');
      echo"<br/>";
      $user_email = array(
        'type' => 'email',
        'name' => 'email',
        'value' => set_value('email')
      );
      echo form_input($user_email);
      echo"<br/>";
      echo"<br/>";
      echo form_label('Password : ');
      echo"<br/>";
      $user_password = array(
        'type' => 'password',
        'name' => 'password',
        'value' => set_value('password')
      );
      echo form_password($user_password);
      echo"<br/>";
      echo"<br/>";
      echo form_submit('submit', 'Sign Up');
      echo form_close();
    ?>
    <a href="<?php echo base_url() ?>auth/login">For Login Click Here</a>
  </div>
</div>
