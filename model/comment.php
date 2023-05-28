<?php
// src/model/comment.php

class Comment
{
    private String $author;
     private String $content;
    private string $french_creation_date;
    
    //constructors
    public function __construct()
    {
    }
    //getteurs
    public function getAuthor()
    {
        return $this->author;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getFrenchCreationDate()
    {
        return $this->french_creation_date;
    }
    //setters
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function setFrenchCreationDate($french_creation_date)
    {
        $this->french_creation_date = $french_creation_date;
    }
    
}
$comment = new Comment();

function getComments(string $post) : array
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$post]);

    $comments = [];
    while (($row = $statement->fetch())) {
        //create comment object
        $comment = new comment();
        //add data to the object
        $comment->setAuthor($row['author']);
        $comment->setContent($row['comment']);
        $comment->setFrenchCreationDate($row['french_creation_date']);
        $comments[] = $comment;
    }

    return $comments;
}

function createComment(string $post, string $author, string $comment)
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
}

function commentDbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    return $database;
}
