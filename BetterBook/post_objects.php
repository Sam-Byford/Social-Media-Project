<?php
    include_once 'db_connect.php';
    $sql = "SELECT * FROM forum_posts";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    class post{
        var $post_author;
        var $post_text;
        var $post_title;
        var $post_date;
        var $post_edit_date;
        
        function get_post_author(){
            return $this->post_author;
        }
        function get_post_text(){
            return $this->post_text;
        }
        function get_post_title(){
            return $this->post_title;
        }
        function get_post_date(){
            return $this->post_date;
        }
        function get_post_edit_date(){
            return $this->post_edit_date;
        }
        
        function set_post_author($postAuthor){
            $this->post_author = $postAuthor;
        }
        function set_post_text($postText){
            $this->post_text = $postText;
        }
        function set_post_title($postTitle){
            $this->post_title = $postTitle;
        }
        function set_post_date($postDate){
            $this->post_date = $postDate;
        }
        function set_post_edit_date($postEditDate){
            $this->post_edit_date = $postEditDate;
        }
    }
        $posts_array = array();
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $next_post = new post();
                $next_post->set_post_author($row['post_author']);
                $next_post->set_post_title($row['post_title']);
                $next_post->set_post_text($row['post_text']);
                $next_post->set_post_date($row['post_date']);
                $next_post->set_post_edit_date($row['edit_date']);
                
                array_push($posts_array, $next_post);
            }
        }