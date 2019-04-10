<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start(); 

include_once 'Header.php';
include 'profile_code.php';
$profileObj = new Profile();

//check for GET data, perform error handling on blank data.
if($_SESSION['user_online']) {
    if(isset($_GET['user'])) {
        $user = $_GET['user'];
        if($user == "") {
            //not the most efficient fix but fix added
            echo '<script>window.location="index.php"</script>';
        } else {    
            //fetch the users profile based on the GET data. 
            //Following this, perform a quick error check on if the user has gone to an invalid user
            $profileData = $profileObj->get_profile($user);
            if($profileData['email'] == "") {
                echo '<script>window.location="index.php"</script>';
            }
            if(isset($_POST['update-bio-hidden']) == "bio-update"){
                $profileObj->updateBio($_POST['bio-text'], $_SESSION['user_online']);
            }
            if(isset($_POST['create-post-hidden']) == "create-post-hidden") {
                $profileObj->create_post($_POST['create-post-title'], $_POST['create-post-text'], $_SESSION['user_online']);
            }
            if(isset($_POST['update_profile_pic']) == 'update_profile_pic') {
                $profileObj->uploadPicture($_FILES["profilePictureToUpload"], $_SESSION['user_online']);
            }
        } 
    } else{
        echo '<script>window.location="index.php"</script>';
    }
} else{
    echo '<script>window.location="index.php"</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/profile.css?version=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">    
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>

<body>
    <div class="row" id="extension2">
        <div class="col-2" id="extension21"></div>
        <div class="col-8" style="padding:0">
            <?php 
                    if($profileData['university'] == 'University of Lincoln') {
                        echo '<img class="img-fluid" id="BannerImage" src="assets/uniBanners/lincoln.jpg" alt="The University of Lincoln">';
                    } else if ($profileData['university'] == 'University of Nottingham') {
                        echo '<img class="img-fluid" id="BannerImage" src="assets/uniBanners/nottingham.jpg" alt="The University of Nottingham">';
                    } else if ($profileData['university'] == 'University of Derby') {
                        echo '<img class="img-fluid" id="BannerImage" src="assets/uniBanners/derby.jpg" alt="The University of Derby">';
                    }
                    ?>
        </div>
        <div clas="col-2" id="extension22"></div>
    </div>
    <div class="row" id="extension3">
        <div class="col-2" id="extension33"></div>
        <div class="col-8" style="background-color: #5f0776" id="ProfileContainer">
            <div class="row" id="profileBox">
                <div class="col-3" style="padding: 5px; padding-right: 0;">
                    <?php
                    if(isset($_SESSION['user_online'])) {
                        if($_SESSION['user_online'] == $profileData['email']) {
                            echo '<img align="left"class="img-fluid" src="assets/' . $profileData['profile_picture'] . '" alt="Me" data-toggle="modal" data-target="#update_profile" id="PPimage">';
                        } else {
                            echo "<img class='img-fluid' src='assets/" . $profileData['profile_picture'] . "' alt='Me' id='PPimage'>";
                        }
                    }
                    ?>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-12 text-center" style="color:white; font-size:3vw;" id="NameHeader">
                            <?php
                                if(isset($_SESSION['user_online'])) {
                                    echo $profileData['first_name']. " " . $profileData['last_name'];
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row text-center" style="font-size:1.7vw;height:70%;">
                        <div class="col-4 align-self-end">
                                <button id="aboutBTN" style="width:90%;background-color:transparent;color:white;border:none" onclick="about()">About Me</button>
                        </div>
                        <div class="col-4 align-self-end">
                            <button id="actBTN" style="width:90%;background-color:transparent;color:white;border:none" onclick="activities()">Activity Feed</button>
                        </div>
                        <div class="col-4 align-self-end">
                            <?php
                                if(isset($_SESSION['user_online'])) {
                                    if($_SESSION['user_online'] == $profileData['email']) {
                                        echo '<button id="createBTN" style="width:90%;background-color:transparent;color:white;border:none" data-toggle="modal" data-target="#create-post">Create Post <i class="fas fa-pencil-alt"></i></button>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row text-centre" style="background-color:white;">
                <div class="col-4 text-center" id="Bio_Div" style="background-color:    #f7c0e5">
                    <div class="modal fade" id="bio-text" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="updateLabel" style="font-size:1.5vw;">Update Your Bio <i class="far fa-smile"></i></h5>
                              </div>
                                <form role="form" method="POST" action="">
                                    <div class="modal-body">
                                        <input type="hidden" value="bio-update" name="update-bio-hidden">
                                        <div class="form-group">
                                            <textarea class="form-control" id="bio-text" name="bio-text" aria-describedby="bio-text" style="resize: none;"><?php echo $profileData['about_text']; ?></textarea>
                                        </div>
                                        <button style="background-color: #5f0776" class="btn btn-primary" type="submit" id="bio-submit" name="bio-submit">Edit <i class="fas fa-pencil-alt"></i></button>
                                  </div>
                                </form>
                            </div>
                          </div>
                        </div>
                        <?php
                        if(isset($_SESSION['user_online'])) {
                            if($_SESSION['user_online'] == $profileData['email']) {
                                echo '<h3 class="text-center" id="Bio" style="font-size:2.5vw;text-decoration: bold; text-align: left; padding-top: 5%; padding-left: 5%; color:#5f0776;" data-toggle="modal" data-target="#bio-text">Bio <i class="fas fa-pencil-alt"></i></h3>';
                            } else {
                                    echo '<h3 class="text-center" id="Bio" style="font-size:2.5vw;text-decoration: bold; text-align: left; padding-top: 5%; padding-left: 5%; color:#5f0776;">Bio</h3>';
                            }
                        }
                    ?>
                    <?php if(isset($_SESSION['user_online'])) { echo "<p style='font-size:1.7vw; word-break: break-word;'>".$profileData['about_text'] . "</p>"; }?>
                </div>
                <div class="col-8 text-center align-self-top" id="info_box"></div>
            </div>
        </div>
        <div class="col-2" id="extension"></div>
    </div>
    
<div class="modal fade" id="create-post" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createLabel">Create Post <i class="far fa-smile"></i></h5>
          </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                    <input type="hidden" value="create-post-form" name="create-post-hidden">
                    <div class="form-group">
                        <input type="text" class="form-control" name="create-post-title" id="create-post-title" aria-describedby="create-post-title" placeholder="Write a cool title!">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="create-post-text" name="create-post-text" aria-describedby="create-post-text" style="resize: none;" placeholder="Write something magical!"></textarea>
                    </div>
                    <button style="background-color: #5f0776" class="btn btn-success" type="submit" id="create-post-submit" name="create-post-submit" style="width: 100%;">Post <i class="far fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update_profile" tabindex="-1" role="dialog" aria-labelledby="updateProfilePic" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProfilePic">Update Your Profile Picture <i class="far fa-smile"></i></h5>
      </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" value="update_profile_pic" name="update_profile_pic">
                <input type="file" name="profilePictureToUpload" id="profilePictureToUpload" /> 
                <button style="background-color: #5f0776" class="btn btn-success" type="submit" id="profile-pic-submit" name="profile-pic-submit">Submit <i class="fas fa-pencil-alt"></i></button>
          </div>
        </form>
    </div>
  </div>
</div>

</body>

<script>
    function about(){
        document.getElementById('info_box').innerHTML = "ABOUT ME CLICKED";
        var user_email = <?php 
            echo json_encode($profileData['email']);?>;
        var user_course = <?php 
            echo json_encode($profileData['course']);?>;
        var user_uni = <?php 
            echo json_encode($profileData['university']);?>;
        var user_name = <?php echo json_encode($profileData['first_name'])?> + " " + <?php echo json_encode($profileData['last_name'])?>;
        
        document.getElementById('info_box').innerHTML = "<p style='font-size:2vw;'>About me</p><br><p style='font-size:1.5vw;'>Hi, my name is " + user_name + "<br> I study " + user_course + " at " + user_uni + "<br> My email address is " + user_email + "<p/>";
    }
    about();
    function activities(){
        document.getElementById('info_box').innerHTML = " ";
        var current_user = <?php echo json_encode($profileData['email']);?>;
        var user_posts = [];
        var all_posts = <?php
        include_once 'post_objects.php';
        echo json_encode($posts_array);?>;
        //console.log(current_user);
        for(var x = 0; x < all_posts.length; x++)
        {
            if(all_posts[x].post_author == current_user){
                user_posts.push(all_posts[x]);
            }
        }
       
        for(var x = 0; x < user_posts.length; x++)
        {
            console.log(x);
            var text = document.getElementById('info_box').innerHTML += "<br><div class='row'><div class='col-12' id='test'><div class='row text-center align-self-center' style='border-radius:12px;height:30px;background-color:#5f0776; text-align:center;color:white'><div class='col-12'>" + user_posts[x].post_title +"</div></div><div class='row text-center align-self-center'><div class='col-12'>"+ user_posts[x].post_text +"</div><hr><div class='col-12'> Post created on - "+ user_posts[x].post_date +"</div></div></div></div><br><hr>";
        }
    }
</script>
</html>