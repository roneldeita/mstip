<h2><?php echo $title; ?></h2>

<?php foreach ($users as $users_item): ?>
  <h3><?php echo $users_item['first_name']; ?></h3>
<?php endforeach; ?>