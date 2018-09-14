<?php
  if (isset($this->session->userdata['logged_in'])) {
    header("location: http://localhost/mstip/index.php/auth/login");
  }
?>
<div class="register">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Register
        </div>
        <div class="card-body">
          <?php
            echo "<div class='text-danger'>";
            if (isset($error_message)) {
              echo '<p>'.$error_message.'</p>';
            }
            echo validation_errors();
            echo "</div>";
          ?>
          <?php
            echo form_open('auth/new_user_registration');

            echo "<div class='form-group'>";
            echo form_label('Account Type');
            $type_of_users = array(
              '' => 'Select',
              'student' => 'Student',
              'parent' => 'Parent',
              'alumni' => 'Alumni'
            );
            echo form_dropdown('role', $type_of_users, [set_value('role')], ['class'=>'form-control']);
            echo "</div>";

            echo "<div class='row'>";
              echo "<div class='col-md-6'>";
                echo "<div class='form-group'>";
                echo form_label('Student ID');
                $student_id = array(
                  'type' => 'text',
                  'name' => 'student_id',
                  'value' => set_value('student_id'),
                  'class' => 'form-control'
                );
                echo form_input($student_id);
                echo "</div>";
              echo "</div>";
              echo "<div class='col-md-6'>";
                echo '<div class="form-group">';
                echo form_label('Email');
                $user_email = array(
                  'type' => 'email',
                  'name' => 'email',
                  'value' => set_value('email'),
                  'class' => 'form-control'
                );
                echo form_input($user_email);
                echo "</div>";
              echo "</div>";
            echo "</div>";

            echo "<div class='row'>";
              echo "<div class='col-md-6'>";
                echo '<div class="form-group">';
                echo form_label('First Name');
                $user_email = array(
                  'type' => 'text',
                  'name' => 'first_name',
                  'value' => set_value('first_name'),
                  'class' => 'form-control'
                );
                echo form_input($user_email);
                echo "</div>";
              echo "</div>";
              echo "<div class='col-md-6'>";
                echo '<div class="form-group">';
                echo form_label('Last Name');
                $user_email = array(
                  'type' => 'text',
                  'name' => 'last_name',
                  'value' => set_value('last_name'),
                  'class' => 'form-control'
                );
                echo form_input($user_email);
                echo "</div>";
              echo "</div>";
            echo "</div>";

            echo "<div class='row'>";
              echo "<div class='col-md-6'>";
                echo '<div class="form-group">';
                echo form_label('Password');
                $user_password = array(
                  'type' => 'password',
                  'name' => 'password',
                  'value' => set_value('password'),
                  'class' => 'form-control'
                );
                echo form_password($user_password);
                echo "</div>";
              echo "</div>";
              echo "<div class='col-md-6'>";
                echo '<div class="form-group">';
                echo form_label('Confirm Password');
                $user_passconf = array(
                  'type' => 'password',
                  'name' => 'passconf',
                  'value' => set_value('passconf'),
                  'class' => 'form-control'
                );
                echo form_password($user_passconf);
                echo "</div>";
              echo "</div>";
            echo "</div>";

            echo form_submit('submit', 'Sign up', ['class'=>'btn']);
            echo form_close();
            echo "<br/>";
            echo anchor(base_url('auth/login'), 'Proceed to login');
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
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
