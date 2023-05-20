<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    // Pega o tipo do form
    $type = filter_input(INPUT_POST, "type");

    // Verifica tipo do formulario
    if($type === "register") {
       
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Verifica dados minimos
    if($name && $lastname && $email && $password){

    } else {

    // Envia mensagem de erro (Falta de dados)
    $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
    }

    

    } else if ($type === ["login"]) {



    }