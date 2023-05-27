<?php
// post.php

require_once('./model/model.php');
require_once('./model/comment.php');

function post(String $identifier)
{
    $post = getPost($identifier);
    $comments = getComments($identifier);
    
    require('view/post.php');
}
