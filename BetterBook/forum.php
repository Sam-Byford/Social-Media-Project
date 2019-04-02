<?php
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(0);

//Displaying Daily Chats
include('daily_chat.php');
$dailyChatObj = new DailyChat();

//For private convos
include('forum_code.php');
$forumCode = new ForumCode();
session_start();

if(!isset($_SESSION['user_online'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Blog Post - Start Bootstrap Template</title>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <!-- Custom styles for this template -->
      <link href="css/quickblog.css" rel="stylesheet">
      <link rel="icon" type="image/png" href="assets/favicon.png">
      <link rel="stylesheet" href="css/chatcss.css">
      <style type="text/css">
        .startMsgUsr:hover 
        {
          opacity: 0.5;
          cursor: pointer;
        }
      </style>
   </head>
   <body style="background: url(assets/lincolnhead.png
) no-repeat center center fixed;
    background-size:cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;">
     <?php include('Header.php'); ?>
      <!-- Page Content -->
      <div class="container">
         <div class="row" style="padding-top: 56px;">
            <!-- Post Content Column -->
            <div class="col-lg-8" id="forumPage" style=" background-color:#5f0776;">
               <h1 class="mt-4">Why Not Try These Chats <i class="fas fa-question"></i></h1>
               <hr>
                <?php 
                  $dailyChats = $dailyChatObj->get_rand_chat();
                  foreach($dailyChats as $dailyChat) {
                    echo 
                      '<div class="card my-4" style="background-color: #b798ec;">
                          <h5 class="card-header">' . $dailyChat[0] . ' ' . $dailyChat[1] . '</h5>
                          <div class="card-body">
                            <p>' . $dailyChat[0] . ' forum <a class="btn btn-success" href="subject_chat_room.php?subject=' . str_replace(' ', '', $dailyChat[2]) . '">here!</a></p>
                          </div>
                        </div>
                      ';
                  }
                ?>
            </div>
            <div class="col-lg-8" id="privateMsgWidget" style="background-color:#5f0776;">
               <h1 class="mt-4">Private Messages</h1>
               <hr>
               <div class="card my-4" style="background-color: #b798ec;">
                  <h5 class="card-header">Private Message</h5>
                  <div class="card-body">
                     <div class="panel panel-primary" style="background-color: #b798ec;">
                        <div class="panel-body">
                           <ul class="chat">
                              <span id="dynamic_chat"></span>
                           </ul>
                        </div>
                        <div class="panel-footer" style="background-color: #b798ec;">
                           <form role="form" method="POST" action="" name="sendMsg" id="sendMsg">
                              <div class="input-group" style="margin-top:-50px;margin-bottom:-40px;">
                                 <input type="hidden" name="receiver" id="receiver" value="">
                                 <input type="hidden" name="sender" id="user_who_online" value="<?php echo $_SESSION['user_online']; ?>">
                                 <input type="text" name="msgbody" id="msgbody" placeholder="Enter your message..." class="form-control" autocomplete="off">
                              </div>
                              <div class="input-group">
                                 <button type="submit" class="form-control btn btn-success" name="msg_post"><span class="fas fa-paper-plane"></span></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
               <!-- Search Widget -->
               <div class="card my-4" style="background-color: #b798ec;">
                  <!--<h5 class="card-header">People </h5>-->                    
                      <div class="card-header" style="background-color: #5f0776;">                            
                          <input type="text" class="form-control" id="searchForUser" placeholder="Search...">
                      </div>
                  <div class="card-body" style="background-color:#5f0776;">
                    <?php //echo 'tester@test.com' 
                      $getUser = $forumCode->get_users();
                      foreach($getUser as $foundUser) {
                        echo '<div class="input-group toggle-prvmsg" style="border: 0.5px solid black; padding: 5px; border-radius: 10px; margin-bottom:5px; background-color:#b798ec;">
                            <img src="assets/generic-profile.png" name="hey" alt="pp" style="height:30px; margin-right: 5px;" class="privMsgUsr">
                            <h5>
                              <span class="startMsgUsr">'. $foundUser['email'] . '</span>
                            </h5>
                         </div>';
                      }
                    ?>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container -->
      <!-- Bootstrap core JavaScript -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script type="text/javascript">
          $(document).ready(function(){
            $(".startMsgUsr").click(function(e) {
              var messageThem = $(this).text();
              $("#receiver").val(messageThem);
            });
            function reloadChat() {
              var online_user = $('#user_who_online').val();
              $.ajax({
                type: "POST",
                url: 'private_room_ajax.php',
                data: {'who_sending': online_user,"messageThem": $("#receiver").val()},
                success: function(data) {
                  console.log('success');
                  $('#dynamic_chat').html(data);
                },
                error: function(xhr){
                  alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
              });
            }

            setInterval(reloadChat, 2000);


            $("#sendMsg").submit(function(e) {
              e.preventDefault();
              var sender = $('#user_who_online').val();
              var receiver = $('#receiver').val();
              var msgContents = $('#msgbody').val();
    
                if ($.trim(msgContents) == "") {
                    return false;
                }
    
              $.ajax({
                type: "POST",
                url: 'sendPrivateMsg.php',
                data: {'sender': sender,'receiver': receiver,'msgContents': msgContents},
                success: function(data) {
                  $('#dynamic_chat').html(data);
                  $('#msgbody').val('');
                },
                error: function(xhr){
                  alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
              });
            });


            $("#privateMsgWidget").hide();
            $(".startMsgUsr").click(function() {
              $("#privateMsgWidget").toggle();
              $("#forumPage").toggle();
            });

            $("#searchForUser").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".toggle-prvmsg").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
          });
      </script>
   </body>
</html>