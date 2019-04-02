<?php
    $sql = "SELECT * FROM accounts";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    class profileClass{
        var $profile_picture;
        var $user_email;
        var $first_name;
        var $last_name;
        var $about_text;
        
        function get_profile_pic(){
            return $this->profile_picture;
        }
        function get_user_email(){
            return $this->user_email;
        }
        function get_first_name(){
            return $this->first_name;
        }
        function get_last_name(){
            return $this->last_name;
        }
        function get_about_text(){
            return $this->about_text;
        }
        
        function set_profile_pic($profilePic){
            $this->profile_picture = $profilePic;
        }
        function set_user_email($Email){
            $this->user_email = $Email;
        }
        function set_first_name($FirstName){
            $this->first_name = $FirstName;
        }
        function set_last_name($lastName){
            $this->last_name = $lastName;
        }
        function set_about_text($about){
            $this->about_text = $about;
        }
    }
        $profiles_array = array();
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $next_profile = new profileClass();
                $next_profile->set_profile_pic($row['profile_picture']);
                $next_profile->set_user_email($row['email']);
                $next_profile->set_first_name($row['first_name']);
                $next_profile->set_last_name($row['last_name']);
                $next_profile->set_about_text($row['about_text']);
                
                array_push($profiles_array, $next_profile);
            }
        }