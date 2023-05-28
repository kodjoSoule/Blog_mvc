<?php
    require_once('./model/postModel.php');
    function addComment(string $post, array $input){
        $author =null;
        $comment = null ;
        if (!empty($input['author']) && !empty(['comment']) ){
            $author = $input['author'];
            $comment = $input['comment'];

        }else{
            
            throw new Exception('Les donnees du formulaire sont invalides');
        }
        $success = createComment($post, $author, $comment);
        if (!$success){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }else{
            header('Location: index.php?action=post&id='.$post);
        }
        
    }
?>