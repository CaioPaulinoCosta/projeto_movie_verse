<?php

    require_once("models/User.php");

    class UserDAO implements UserDAOInterface {

        private $conn;
        private $url;

        public function __construct(PDO $conn, $url) {
            $this->$conn = $conn;
            $this->url = $url;
        }

        public function buildUser($data) {

            $user = new User();

            $user->id = $data["id"];
            $user->id = $data["name"];
            $user->id = $data["lastname"];
            $user->id = $data["email"];
            $user->id = $data["password"];
            $user->id = $data["image"];
            $user->id = $data["bio"];
            $user->id = $data["token"];

            return $user;

        }
        public function create(User $user, $authUser = false) {

        }
        public function updtate(User $user) {

        }
        public function verifyToken($protected = false) {

        }
        public function setTokeToSession($token, $redirect = true) {

        }
        public function autheticateUser($email, $password) {

        }
        public function findByEmail($email) {

        }
        public function findById($id) {

        }
        public function findByToken($token) {

        }
        public function changePassword(User $user) {

        }

    }