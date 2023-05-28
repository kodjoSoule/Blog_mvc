<?php
// post.php

require_once('./model/postModel.php');
require_once('./model/commentModel.php');

function post(String $identifier)
{
    $postModel = new PostModel();
    $postModel->database = new DatabaseConnection();
    $post = $postModel->getPost($identifier);
    
    $comments = getComments($identifier);
    
    require_once('view/post.php');
}
