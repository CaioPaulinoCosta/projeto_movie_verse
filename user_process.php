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
if($type === "update") {

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

    $userDao->update($userData);

// Atualiza senha do usuario
} else if ($tpye === "changepassword") {

    $message->setMessage("Informações inválidas!", "error", "index.php");
}