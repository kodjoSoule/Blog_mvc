<?php
function dbConnect()
{

    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    return $database;
}


function getPosts()
{
    // Connexion à la base de données
    $database = dbConnect();

    // On récupère les 5 derniers billets
    $statement = $database->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_creation_fr DESC LIMIT 0, 5');

    while ($row = $statement->fetch()) {
        $post = [
            'title' => $row['title'],
            'content' => $row['content'],
            'french_creation_date' => $row['date_creation_fr'],
            'identifier' => $row['id'],
        ];
        $posts[] = $post;
    }
    $statement->closeCursor();
    $database = null;
    return $posts;
}
function getPost($_id)
{
    $database = dbConnect();
    $statement = $database->prepare(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"

    );
    $statement->execute([$_id]);
    $row = $statement->fetch();

    $post = [
        'identifier' => $row['id'],
        'title' => $row['title'],
        'content' => $row['content'],
        'french_creation_date' => $row['french_creation_date']
    ];

    $statement->closeCursor();
    $database = null;
    return $post;
}

// function getComments($id)
// {
//     $database = dbConnect() ;
//     $statement = $database->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m%Y a %Hh%imin%ss') as french_creation_date from comments WHERE post_id = ? ORDER BY comment_date DESC");
//     $statement->execute([$id]);
//     $comments = [];
//     while ($row = $statement->fetch()) {
//         $comment = [
//             'author' => $row['author'],
//             'comment' => $row['comment'],
//             'french_creation_date' => $row['french_creation_date'],
//         ];
//         $comments[] =$comment ;
//     }
//     $statement->closeCursor();
//     $database = null;
//     return $comments;
// }
//add_comment
