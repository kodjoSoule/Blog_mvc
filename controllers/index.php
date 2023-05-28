<?php 
   require_once("./model/postModel.php");
   $posts = getPosts();
   
   require("./front/homepage.php") ;
?>