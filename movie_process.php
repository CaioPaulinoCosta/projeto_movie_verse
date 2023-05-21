<?php 

require_once("globals.php");
require_once("db.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// Pega o tipo do formulario
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuario
$userData = $userDao->verifyToken();

if($type === "create") {

    // Recebe dados do input
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    // Valida dados minimos
    if(!empty($title) && !empty($description) && !empty($category)) {

    $movie->title = $title;
    $movie->description = $description;
    $movie->trailer = $trailer;
    $movie->category = $category;
    $movie->length = $length;

    // Upload de imagem do filme
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

    $image = $_FILES["image"];
    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
    $jpgArray = ["image/jpeg", "image/jpg"];

    // Checa o tipo da imagem 
    if (in_array($image["type"], $imageTypes)) {
        if (in_array($image["type"], $jpgArray)) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
        } else {
            if (getimagesize($image["tmp_name"]) !== false) {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            } else {
                $message->setMessage("Arquivo PNG inválido!", "error", "index.php");
            }
        } 

        if ($imageFile) {
            $imageName = $movie->imageGenerateName();
            imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
            $movie->image = $imageName;
        }
    } else {
        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "index.php");
    }


    } 

    print_r($_POST); print_r($_FILES); exit;

    $movieDAO->create($movie);

    } else {

    $message->setMessage("Você precisa ao menos adicionar: Titulo, Descrição e Categoria!", "error", "back");

    }

} else {

    $message->setMessage("Informações inválidas", "error", "index.php");

}