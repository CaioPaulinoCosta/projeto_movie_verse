<?php

    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDao = new UserDAO($conn, $BASE_URL);

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

    // Verifica se as senhas são iguais

    if($password === $confirmpassword){

     // Verifica se o email já está cadastrado. 
     if($userDao->findByEmail($email) === false) {

    echo "Nenhum usuário foi encontado!";

     } else {

    // Envia mensagem de erro (O email já está sendo utilizado)
     $message->setMessage("O email já está sendo utilizado.", "error", "back");

     }

    } else {

    // Envia mensagem de erro (As senhas não são iguais)
    $message->setMessage("As senhas não são iguais.", "error", "back");

    }

    } else {

    // Envia mensagem de erro (Falta de dados)
    $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
    }

    

    } else if ($type === ["login"]) {



    }