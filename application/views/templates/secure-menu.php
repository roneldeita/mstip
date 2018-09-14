<div class="menu">
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a href="<?php echo base_url() ?>secure/dashboard" class="nav-link <?php echo uri_string() == 'secure/dashboard' ?  'active' : '' ?>" >Dashboard</a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url() ?>jobs" class="nav-link <?php echo uri_string() == 'jobs' ?  'active' : '' ?>">View Jobs</a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url() ?>chats" class="nav-link <?php echo uri_string() == 'chat' ?  'active' : '' ?>">Enter Chat</a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url() ?>auth/logout" class="nav-link">Logout</a>
    </li>
  </ul>
</div>
