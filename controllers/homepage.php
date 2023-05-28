<?php
// controllers/homepage.php

require_once('./model/postModel.php');

function homepage() {
	$posts = getPosts();
   
	require('view/homepage.php');
}