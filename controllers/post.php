<?php
// post.php

require_once('./model/postModel.php');
require_once('./model/commentModel.php');

function post(String $identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);
    
    require_once('view/post.php');
}
