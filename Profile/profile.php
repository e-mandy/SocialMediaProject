<?php

    class Profile{
        private $pdo = new Database("localhost", "root", "");
        private $pseudo;
        private $email;
        private $password;
        private $birthday;
        private $biography;
        private $picture;


        private function __construct($pseudo, $email, $password, $birthday){
            $this->pseudo = $pseudo;
            $this->email = $email;
            $this->password = $password;
            $this->birthday = $birthday;

            $connect = $this->pdo->getConnect();

            try{
                $query = "INSERT INTO User(pseudo, email, password, birthday) VALUES (? ? ? ?)";
                $exec = 

            }catch(PDOException $exception){
                echo "L'insertion de l'utilisateur n'a pas fonctionné : ". $exception->getMessage();
            }
        }
    }
?>
