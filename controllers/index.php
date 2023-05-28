<?php 
   require_once("./model/postModel.php");
   $postModel = new PostModel();
   $postModel->database = new DatabaseConnection();
    $posts = $postModel->getPosts();
   
   
   require("./front/homepage.php") ;
?>