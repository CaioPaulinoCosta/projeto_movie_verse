<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

// Pega o tipo do formulario
$type = filter_input(INPUT_POST, "type");

// Atualiza o usuario
if ($type === "update") {

    // Pega dados do usuario
    $userData = $userDao->verifyToken();

    // Recebe dados do POST
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    // Cria novo objeto de usuario
    $user = new User();

    // Preenche os dados do usuario
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    // Upload da imagem de usuario
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        // Checagem de tipo de imagem
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
                $imageName = $user->imageGenerateName();
                imagejpeg($imageFile, "./img/users/" . $imageName, 100);
                $userData->image = $imageName;
            }
        } else {
            $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "index.php");
        }
    }


    $userDao->update($userData);

    // Atualiza senha do usuario
} else if ($type === "changepassword") {

    // Recebe dados do POST
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
    
    // Resgata dados do usuario
    $userData = $userDao->verifyToken();
    $id = $userData->$id;

    if($password == $confirmpassword) {

    // Cria um novo objeto de usuario
    $user = new User();

    $finalPassword = $user->generatePassword($password);

    $user->password = $finalPassword;
    $user->id = $id;

    $userDao->changePassword($user);

    } else {
    $message->setMessage("As senhas não são iguais.", "error", "back");
    }
} else {

    
}
