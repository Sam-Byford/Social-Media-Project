<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(!$_SESSION['user_online']) {
  header('Location: login.php');
}

$subject = $_GET['subject'];
include_once('subject_chat_code.php');
$pcObj = new SubjectChat();
/*if(isset($_SESSION['user_online'])) {
  $profileData = $pcObj->get_profile($_SESSION['user_online']);
}*/
?>
<!doctype html>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="css/private_chat_room.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style type="text/css">
    #sign-out:hover {
      opacity: 0.5;
    }
  </style>
</head>
<body style="background: url(assets/lincolnlib.jpg
) no-repeat center center fixed;
    background-size:cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;">
    
    <?php include 'Header.php'; ?>
<div class="container" style="background-color: grey; color: grey;">
<h3 class=" text-center" style='color:white;'><?php echo $subject . ' Chat Room | '; if(isset($_SESSION['user_online'])) { echo "<a href='index.php' style='color:purple;'>Rooms</a> | Logout <a href='user_access_code.php?logout' id='signout-out'><i class='fas fa-sign-out-alt'></i></a>"; } ?></h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people" style="background-color: #5f0776;">
          <div class="headind_srch" style="margin-top:-50px;">
            <!-- Search form -->
            <input type="text" class="form-control" id="searchForUser" placeholder="Search User...">
          </div>
          <div class="inbox_chat" >
            <?php //echo 'tester@test.com' 
                $getUser = $pcObj->get_users($subject);
                foreach($getUser as $foundUser) {
                  echo '<div class="chat_list">
                    <div class="chat_people">
                      <div class="chat_img"> <img src="assets/' . $foundUser['profile_picture'] . '" alt="pp"> </div>
                      <div class="chat_ib">
                        <h5>' . ucfirst($foundUser['first_name']) . " " . ucfirst($foundUser['last_name']) . '</h5>
                        <!--<span class="chat_date">04/03/2019</span><p>Marmelade.</p>-->
                      </div>
                    </div>
                  </div>';
                }
              ?>
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history">
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <form name="subjectSubmitMsg" id="subjectSubmitMsg">
                <div class="form-group">
                  <input type="hidden" name="sender" id="user_who_online" value="<?php echo $_SESSION['user_online']; ?>">
                  <input type="hidden" name="receiver" id="course_name" value="<?php echo $subject; ?>">
                  <input type="text" class="form-control" name="subjectTxt" id="subjectTxt" placeholder="Write your message and press enter..." autocomplete="off"/>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      var ajaxCall=function() {
        var online_user = $("#user_who_online").val();
        var subject_name = $('#course_name').val();
        $.ajax({
            type:'POST',
            url:'subject_room_get.php',
            data: {'online_user': online_user, 'subject_name': subject_name},
            success:function(data)
            {
              $('.msg_history').html(data);
            }
        });
      }
      setInterval(ajaxCall,1000);
      $("#subjectSubmitMsg").submit(function(e) {
          e.preventDefault();
          var sender = $('#user_who_online').val();
          var msgContents = $('#subjectTxt').val();
          var receiver = $('#course_name').val();
    
            if ($.trim(msgContents) == "") {
                return false;
            }
            
          $.ajax({
            type: "POST",
            url: 'subject_chat_send.php',
            data: {'sender': sender, 'receiver': receiver, 'msgContents': msgContents},
            success: function(data) {
              console.log('successfully sent message');
              $('#subjectTxt').val('');
            },
            error: function(xhr){
              alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
          });
        });
      
      $("#searchForUser").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".chat_list").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
    </body>
    </html>