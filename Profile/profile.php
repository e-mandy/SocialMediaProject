<?php

    class Profile{
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

            $pdo = new Database("localhost", "root", "");
            
            try{
                $query = "INSERT INTO User(pseudo, email, password, birthday) VALUES (? ? ? ?)";
                $exec = $pdo->prepare($query);


            }catch(PDOException $exception){
                echo "L'insertion de l'utilisateur n'a pas fonctionné : ". $exception->getMessage();
            }
        }
    }
?>
