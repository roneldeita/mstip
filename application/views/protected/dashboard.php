
<?php
  if (isset($this->session->userdata['logged_in'])) {
    $studentid = ($this->session->userdata['logged_in']['student_id']);
    $email = ($this->session->userdata['logged_in']['email']);
  } else {
  header("location: login");
}
?>
<div>
  <?php echo $studentid ?>
  <b id="logout"><a href="<?php echo base_url() ?>auth/logout">Logout</a></b>
</div>
