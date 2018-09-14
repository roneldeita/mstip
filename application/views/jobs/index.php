<div class="jobs">
  <div class="row justify-content-md-center">
    <div class="col-md-11">
      <h6><b><?php echo $title ?></b><h6>
      <hr/>
    </div>
    <div class="col-md-11">
      <?php 
        echo "<div class='row'>";
        foreach ($jobs as $job):
          echo "<div class='col-md-3'>";
            echo "<div class='card'>";
              echo "<img class='card-img-top' sty src='".base_url('../public/images/jobs/'.$job['thumbnail'])."' alt='Card image cap'>";
              echo "<div class='card-body'>";
                echo "<h5 class='card-title'>".$job['title']."</h5>";
                echo "<p>".$job['description']."</p>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        endforeach;
        echo "</div>";
      ?>
    </div>
  </div>
</div>