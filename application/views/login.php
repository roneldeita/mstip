<!-- <head>
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body> -->
<?php
  if (isset($this->session->userdata['logged_in'])) {
    header("location: http://localhost/mstip/index.php/secure/dashboard");
  }
?>
<?php
  if (isset($logout_message)) {
    echo "<div class='message'>";
    echo $logout_message;
    echo "</div>";
  }
?>
<?php
  if (isset($message_display)) {
  echo "<div class='message'>";
  echo $message_display;
  echo "</div>";
}
?>
<div id="main">
  <div id="login">
  <h2>Login Form</h2>
    <hr/>
    <?php
      echo form_open('auth/handle_user_login');
      echo "<div class='error_msg'>";
      if (isset($error_message)) {
        echo $error_message;
      }
      echo validation_errors();
      echo "</div>";
      echo form_label('Email:');
      echo"<br/>";
      $user_email = array(
        'type' => 'email',
        'name' => 'email'
      );
      echo form_input($user_email);
      echo"<br/>";
      echo"<br/>";
      echo form_label('Password : ');
      echo"<br/>";
      $user_password = array(
        'type' => 'password',
        'name' => 'password'
      );
      echo form_password($user_password);
      echo"<br/>";
      echo"<br/>";
      echo form_submit('submit', 'Login');
      echo form_close();
    ?>
    <a href="<?php echo base_url() ?>auth/register">To SignUp Click Here</a>
    <?php echo form_close(); ?>
  </div>
</div>
