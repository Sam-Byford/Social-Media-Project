<?php error_reporting(E_ALL ^ E_NOTICE);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Header CSS file -->
    <link type=text/css rel="stylesheet" href="css/Header.css?version=1">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <!-- Icon library for 'close' icon on mobile menu -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- JQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>BetterFace</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Mobile logo, hidden by default -->
        <div class="logo">
             <?php
        session_start();
        if(isset($_SESSION['user_online'])) {
            echo '<img id="menu" src="assets/logo_transparent.png" alt="logo_menu">';
        }
        ?>
        </div>
        <!-- left side header nav bar -->
        <div class="col" id="links">
            <a href="jobs.php"><span class="hvr-underline-from-center" id="Jobs_Link">Jobs</span></a>
            <a href="forum.php"><span class="hvr-underline-from-center" id="forum_link">Forum</span></a>
            <?php
            session_start();
            if($_SESSION['user_online']) {
                echo '<a href="profile_page.php?user=' . $_SESSION['user_online'] . '"><span class="hvr-underline-from-center" id="Profile_Link">Profile</span></a>';
            }
            ?>
            <a href="index.php"><span class="hvr-underline-from-center" id="Chats_Link">Rooms</span></a>
        </div>
        <!-- Logo -->
        <div class="col" id="logo">
            <?php
                if($_SESSION['user_online']) {
                    echo '<a href="home_page.php"><img src="assets/logo_transparent.png" height="100px" width="100px"></a>';
                } else {
                    echo '<a href="index.php"><img src="assets/logo_transparent.png" height="100px" width="100px"></a>';
                }
            ?>
        </div>
        <!-- Right side nav and search bar -->
        <div class="col" id="social">
            <?php
                if($_SESSION['user_online']) {
                    echo '<form class="SearchSpace" action="">
                        <button type="submit" id="SubmitButton"><i class="fa fa-search"></i></button>
                        <input type="text" id="search" name="search" placeholder="Search.." autocomplete="off">
                    </form>';
                }
                if($_SESSION['user_online']) {

                    echo '<a href="user_access_code.php?logout"><span class="glyphicon glyphicon-off" id="icons2"></span></a>';
                    echo '<a href="profile_page.php?user=' . $_SESSION['user_online'] . '"><span class="glyphicon glyphicon-user" id="icons"></span></a>';
                }
                ?>
            <a href="forum.php" id="forum_link"><span class="glyphicon glyphicon-envelope" id="icons3"></span></a>
            <div class="dropdown">
                <div class="dropdown-menu" id="searchBox" style="margin-left: 100px; "></div>
            </div>
        </div>
    </div>
    <!-- Mobile menu, hidden by default -->
    <div id="mySidenav" class="sidenav">
        <i id="close" class="fa fa-times-circle-o" aria-hidden="true"></i>
        <a href="home_page.php">Home</a>
        <a href="jobs.php">Jobs</a>
        <a href="forum.php" target="_blank">Forum</a>
        <a href="index.php">Rooms</a>
        <?php
        session_start();
        if(isset($_SESSION['user_online'])) {
            echo '<a href="profile_page.php?user=' . $_SESSION['user_online'] . '">Profile</a>';
            echo '<a href="user_access_code.php?logout">Logout</a>';
        }
        ?>
    </div>
    </div>
    <!-- Mobile search bar, hidden by default -->
    <form class="SearchSpace" action="">
        <button type="submit" id="Mobile_SubmitButton"><i class="fa fa-search"></i></button>
        <input type="text" id="mobile-search" name="search" placeholder="Search..">
    </form>
    <div class="dropdown">
        <div class="dropdown-menu" id="mobile-searchBox" style="margin-left: 100px; "></div>
    </div>
</div>
<!-- Header JavaScript file (CURRENTLY NOT LOADING)
<script src="js/Header.js"></script>-->
<script>
        console.log('Header Page JS loaded.');
    console.log('9 Changes have been made');

    //Animated search bar
    function expand() {
        $(".search").toggleClass("close");
        $(".input").toggleClass("square");
        if ($('.search').hasClass('close')) {
            $('input').focus();
        } else {
            $('input').blur();
        }
    }

    $('button').on('click', expand);
    window.onload = function() {
        //stores the windows dimensions for checking later on
        height = $(window).height();
        width = $(window).width();
        //displays the mobile menu if the screen size is small enough on the page loading
        if (width <= 610) {
            document.getElementById("menu").style.display = "block";
            document.getElementById("mobile-search").style.display = "block"
            document.getElementById("Mobile_SubmitButton").style.display = "block"
        } else if (width >= 610) {
            document.getElementById("menu").style.display = "none";
            document.getElementById("mobile-search").style.display = "none"
            document.getElementById("Mobile_SubmitButton").style.display = "none"
        }
        //function does the same as above but dynamically, not just on page load
        var resize = $(window).resize(function () {
            // This will execute whenever the window is re-sized
            var win = $(this); //this = window
            if (win.width() <= 610) {
                document.getElementById("menu").style.display = "block";
                document.getElementById("mobile-search").style.display = "block"
                document.getElementById("Mobile_SubmitButton").style.display = "block"
            } else if (win.width() >= 610) {
                console.log('Resize function');
                document.getElementById("menu").style.display = "none";
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("mobile-search").style.display = "none"
                document.getElementById("Mobile_SubmitButton").style.display = "none"
            }

        });
    }

    //displays the menu when clicked
    $('#menu').click(function () {
        document.getElementById("mySidenav").style.width = "200px";
    })
    //closes menu when exit icon is clicked
    $('#close').click(function () {
        document.getElementById("mySidenav").style.width = "0";
    })


    $("#search").keyup(function() {
        var search = $('#search').val();
        if (search == "") {
            $("#searchBox").html("");
            $("#searchBox").hide();
        } else {
            $.ajax({
                type: "POST",
                url: 'search_bar_ajax.php',
                data: {'search': search},
                success: function(data) {
                    $('#searchBox').html(data).show();
                },
                error: function(err){
                    console.log(err);
                }
            });
        }
    });
    
    $("#mobile-search").keyup(function() {
        var mobile_search = $('#mobile-search').val();
        if (mobile_search == "") {
            $("#mobile-searchBox").html("");
            $("#mobile-searchBox").hide();
        } else {
            $.ajax({
                type: "POST",
                url: 'search_bar_ajax.php',
                data: {'mobile_search': mobile_search},
                success: function(data) {
                    $('#mobile-searchBox').html(data).show();
                },
                error: function(err){
                    console.log(err);
                }
            });
        }
    });
</script>
</body>
</html>
