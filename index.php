<?php
require_once('controllers/homepage.php');
require_once('controllers/post.php');
require_once('controllers/add_comment.php');
try{
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                post($identifier);
            } else {
                echo 'Erreur : aucun identifiant de billet envoyé';

                die;
            }
        }elseif ($_GET['action'] === 'addComment' ){
            if( isset($_GET['id'] ) && $_GET['id'] > 0 ){
                $identifier = $_GET['id'];
                addComment($identifier, $_POST);
            }else{
                throw new Exception ('Aucun identifiant de billet envoye');
            }

        }else {
            throw new Exception ('404 - La page que vous recherchez n\'existe pas ');
        }
    } else {
        homepage();
    }
}catch(Exception $e){
    $errorMessage = $e->getMessage();
	require('templates/error.php');
}