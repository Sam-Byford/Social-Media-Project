<?php

//Including Database configuration file.

include_once "database.php";
$db = new Database();
$connection = $db->open_connection("id8787309_betterbook_db");

//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
    
  $search = $_POST['search'];
  $Query = "SELECT profile_picture, email FROM accounts WHERE email LIKE '%$search%' LIMIT 5";
  
  $ExecQuery = MySQLi_query($connection, $Query);

   //Fetching result from database.

   while ($Result = MySQLi_fetch_array($ExecQuery)) {
    echo '
        <a class="dropdown-item" href="profile_page.php?user=' . $Result['email'] . '">
          <img align="left" id="ProfilePicture" src="assets/' . $Result['profile_picture'] . '" width=50 style="padding-right: 5px;"> ' . $Result['email'] . '</a>';
    }
} else if(isset($_POST['mobile_search'])) {
    $mobile_search = $_POST['mobile_search'];
    $MobileQuery = "SELECT profile_picture, email FROM accounts WHERE email LIKE '%$mobile_search%' LIMIT 5";
    
    $ExecMQuery = MySQLi_query($connection, $MobileQuery);

    //Fetching result from database.

    while ($MobileResult = MySQLi_fetch_array($ExecMQuery)) {
        echo '
            <a class="dropdown-item" href="profile_page.php?user=' . $MobileResult['email'] . '">
            <img align="left" id="ProfilePicture" src="assets/' . $MobileResult['profile_picture'] . '" width=50 style="padding-right: 5px;"> ' . $MobileResult['email'] . '</a>';
    }
} else {
    header('Location: www.google.co.uk');
}
?>