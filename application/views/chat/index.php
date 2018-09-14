<?php
  if (isset($this->session->userdata['logged_in'])) {
    $studentid = ($this->session->userdata['logged_in']['student_id']);
  }
?>
<div class="chat">
  <div class="row justify-content-md-center">
    <div class="col-md-11">
      <h6><b><?php echo $title ?></b><h6>
      <hr/>
    </div>
    <div class="col-md-11">
      <div class="card">
        <div class="card-body" id="chat-window">
          <?php 
            echo "<ul class='list-group list-group-flush' id='chat-orderlist'>";
            foreach ($chats as $chat):
              echo "<li class='list-group-item'>";
                echo "<div class='row'>";
                  if($chat['student_id'] === $studentid){
                    echo "<div class='col-md-11'>";
                      echo "<p class='float-right'><b>".$chat['display_name']."</b></p>";
                      echo "<p>".date("F j, Y, g:i a", strtotime($chat['timestamp']))."</p>";
                      echo "<p>".$chat['message']."</p>";
                    echo "</div>";
                    echo "<div class='col-md-1'>";
                      echo '<img data-name="'.$chat['display_name'].'" class="inital rounded-circle" />';
                    echo "</div>";
                  }else{
                    echo "<div class='col-md-1'>";
                      echo '<img data-name="'.$chat['display_name'].'" class="inital rounded-circle" />';
                    echo "</div>";
                    echo "<div class='col-md-11'>";
                      echo "<p class='float-right'>".date("F j, Y, g:i a", strtotime($chat['timestamp']))."</p>";
                      echo "<p><b>".$chat['display_name']."</b></p>";
                      echo "<p>".$chat['message']."</p>";
                    echo "</div>";
                  }
                echo "</div>";
              echo "</li>";
            endforeach;
            echo "</ul>";
          ?>
        </div>
        <div class="card-footer">
          <form>
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <textarea class="form-control" id="message-box" rows="3" placeholder="Type your message"></textarea>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <button type="submit" class="btn btn-danger chat-send">Send</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script>
  $(document).ready(function() {
    let InitialChats = '<?php echo json_encode($chats) ?>';
    let LastItem = JSON.parse(InitialChats).shift();
    let LastID = LastItem.id;
    let ScrollPos = 0; 
    //make initialavatar
    function runInitial(){
      $('.inital').initial({
        radius: 10,
        charCount: 2,
        width:40,
        height:40,
        fontSize: 14
      });
    }
    //scroll down
    $('#chat-window').scrollTop($('#chat-window')[0].scrollHeight);

    //on click send button
    $('.chat').on('click', '.chat-send', function(e){
      e.preventDefault();
      let Msg = $('#message-box').val();
      if(Msg === ''){
        bootbox.alert({
          message:'Empty message cannot send', 
          size: 'small', 
          backdrop: true});
      }else{
        //send message using ajax
        $.post('http://localhost/mstip/index.php/chats/send_message',{message:Msg})
        .done(function(res){
          $('#message-box').val('');
        });
      }
    });
    
    //on scroll message box load older messages
    $('#chat-window').scroll(function(e){
      ScrollPos = $(this).scrollTop();
      if(ScrollPos === 0){
        $.get('http://localhost/mstip/index.php/chats/load_message', {last_id:LastID})
        .done(function(res){
          var result = JSON.parse(res);
          $.each(result['chats'], function(index, value){
            // populate older chats
            if(Number(value['student_id']) === <?php echo strval($studentid) ?>){
              $('#chat-orderlist').prepend(
                "<li class='list-group-item'>"+
                  "<div class='row'>"+
                    "<div class='col-md-11'>"+
                      "<p class='float-right'><b>"+value['display_name']+"</b></p>"+
                      "<p>"+moment(value['timestamp']).calendar()+"</b></p>"+
                      "<p>"+value['message']+"</p>"+
                    "</div>"+
                    "<div class='col-md-1'>"+
                      "<img data-name='"+value['display_name']+"' class='inital rounded-circle' />"+
                    "</div>"+
                  "</div>"+
                "</li>"
              );
            }else{
              $('#chat-orderlist').prepend(
                "<li class='list-group-item'>"+
                  "<div class='row'>"+
                    "<div class='col-md-1'>"+
                      "<img data-name='"+value['display_name']+"' class='inital rounded-circle' />"+
                    "</div>"+
                    "<div class='col-md-11'>"+
                    "<p class='float-right'>"+moment(value['timestamp']).calendar()+"</dpiv>"+
                    "<p><b>"+value['display_name']+"</b></p>"+
                    "<p>"+value['message']+"</p>"+
                    "</div>"+
                  "</div>"+
                "</li>"
              );
            }
            runInitial();
          });
          //get the last chat
          var LastItem = result['chats'].pop()
          //set the new last chat id
          if(LastItem){
            LastID = LastItem['id']
          }
          //scrool down a little
          $('#chat-window').scrollTop(10);
        });
      }
    });
    
    //pusher for realtime
    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;
    //credentials
    var pusher = new Pusher('d3d2293f6af467fee07c', {
      cluster: 'ap1',
      forceTLS: true
    });
    //append received data
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      var result = JSON.parse(data);
      if(Number(result['student_id']) === <?php echo strval($studentid) ?>){
        $('#chat-orderlist').append(
          "<li class='list-group-item'>"+
            "<div class='row'>"+
              "<div class='col-md-11'>"+
                "<p class='float-right'><b>"+result['display_name']+"</b></p>"+
                "<p>"+moment(result['timestamp']).calendar()+"</b></p>"+
                "<p>"+result['message']+"</p>"+
              "</div>"+
              "<div class='col-md-1'>"+
                "<img data-name='"+result['display_name']+"' class='inital rounded-circle' />"+
              "</div>"+
            "</div>"+
          "</li>"
        );
      }else{
        $('#chat-orderlist').append(
          "<li class='list-group-item'>"+
            "<div class='row'>"+
              "<div class='col-md-1'>"+
                "<img data-name='"+result['display_name']+"' class='inital rounded-circle' />"+
              "</div>"+
              "<div class='col-md-11'>"+
              "<p class='float-right'>"+moment(result['timestamp']).calendar()+"</dpiv>"+
              "<p><b>"+result['display_name']+"</b></p>"+
              "<p>"+result['message']+"</p>"+
              "</div>"+
            "</div>"+
          "</li>"
        );
      }
      runInitial();
      $('#chat-window').scrollTop($('#chat-window')[0].scrollHeight);
    });

    runInitial();
  });
</script>