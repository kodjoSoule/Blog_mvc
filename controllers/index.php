<?php 
   require_once("./model/model.php");
   $posts = getPosts();
   
   require("./front/homepage.php") ;
?>