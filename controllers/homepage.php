<?php
// controllers/homepage.php

require_once('./model/postModel.php');

function homepage()
{
   $postModel = new PostModel();
   $postModel->database = new DatabaseConnection();
   $posts = $postModel->getPosts();
   require('view/homepage.php');
}
