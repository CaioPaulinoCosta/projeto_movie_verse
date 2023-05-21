<?php

require_once("models/movie.php");
require_once("models/Message.php");

// Review DAO

class MovieDAO implements MovieDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildMovie($data) {

        $movie = new Movie();

        $movie->id = $data["id"];
        $movie->title = $data["title"];
        $movie->description = $data["description"];
        $movie->image = $data["image"];
        $movie->trailer = $data["trailer"];
        $movie->category = $data["category"];
        $movie->lenght = $data["lenght"];
        $movie->users_id = $data["users_id"];

        return $movie;
    }

    public function findAll() {

    }

    public function getLatestMovies() {

    $movies = [];

    $stmt = $this->conn->query("SELECT * FROM movies ORDER BY
    id DESC");

    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $moviesArray = $stmt->fetchAll();

    foreach($moviesArray as $movie) {
        $movies[] = $this->buildMovie($movie);
    }

}
    return $movies;

    }

    public function getMoviesByCategory($category) {

        $movies = [];
  
        $stmt = $this->conn->prepare("SELECT * FROM movies
                                      WHERE category = :category
                                      ORDER BY id DESC");
  
        $stmt->bindParam(":category", $category);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
          $moviesArray = $stmt->fetchAll();
  
          foreach($moviesArray as $movie) {
            $movies[] = $this->buildMovie($movie);
          }
  
        }
  
        return $movies;
  
      }

    public function getMoviesByUserId($id) {

        $movies = [];
  
        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE users_id = :users_id");
  
        $stmt->bindParam(":users_id", $id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
          $moviesArray = $stmt->fetchAll();
  
          foreach($moviesArray as $movie) {
            $movies[] = $this->buildMovie($movie);
          }
  
        }
  
        return $movies;

    }

    public function findById($id) {

    }

    public function findByTitle($title) {

    }

    public function create(Movie $movie) {

        $stmt = $this->conn->prepare("INSERT INTO movies (
        title, description, image, trailer, category, lenght, users_id
        ) VALUES (:title, :description, :image, :trailer, :category, :lenght, :users_id
        )");

        $stmt->bindParam(":title", $movie->title);
        $stmt->bindParam(":description", $movie->description);
        $stmt->bindParam(":image", $movie->image);
        $stmt->bindParam(":trailer", $movie->trailer);
        $stmt->bindParam(":category", $movie->category);
        $stmt->bindParam(":lenght", $movie->lenght);
        $stmt->bindParam(":users_id", $movie->users_id);

        $stmt->execute();

        // Mensagem de sucesso por adicionar um filme/ redireciona para o perfil o home
        $this->message->setMessage("Filme adicionado com sucesso!", "success", "index.php");

    }

    public function update(Movie $movie) {

    }

    public function destory($id) {

    }

}