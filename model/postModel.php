<?php

// Post Class

class Post{
    private $id;
    private $title;
    private $content;
    private $french_creation_date;

    //constructor 
    public function __contructor(){

    }
	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * @param mixed $title 
	 * @return self
	 */
	public function setTitle($title): self {
		$this->title = $title;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getContent() {
		return $this->content;
	}
	
	/**
	 * @param mixed $content 
	 * @return self
	 */
	public function setContent($content): self {
		$this->content = $content;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getFrench_creation_date() {
		return $this->french_creation_date;
	}
	
	/**
	 * @param mixed $french_creation_date 
	 * @return self
	 */
	public function setFrench_creation_date($french_creation_date): self {
		$this->french_creation_date = $french_creation_date;
		return $this;
	}
}
function dbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    return $database;
}


function getPosts() : array
{
    // Connexion à la base de données
    $database = dbConnect();

    // On récupère les 5 derniers billets
    $statement = $database->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY date_creation_fr DESC LIMIT 0, 5');

    while ($row = $statement->fetch()) {
        //create post object
        $post = new Post();
        $post->setId($row['id']);
        $post->setTitle($row['title']);
        $post->setContent($row['content']);
        $post->setFrench_creation_date($row['date_creation_fr']);
        //add post to array
        $posts[] = $post;
    }
    $statement->closeCursor();
    $database = null;
    return $posts;
}
function getPost($_id) : Post
{
    $database = dbConnect();
    $statement = $database->prepare(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"

    );
    $statement->execute([$_id]);
    $row = $statement->fetch();
	//create post object
	$post = new Post();
	$post->setId($row['id']);
	$post->setTitle($row['title']);
	$post->setContent($row['content']);
	$post->setFrench_creation_date($row['french_creation_date']);

    $statement->closeCursor();
    $database = null;
    return $post;
}

