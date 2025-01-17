<?php

    class Profile{
        private $pdo;
        private $pseudo;
        private $email;
        private $password;
        private $birthday;
        private $biography;
        private $picture;


        private function __construct($pseudo, $email, $password, $birthday, $biography, $picture){
            $this->pseudo = $pseudo;
            $this->email = $email;
            $this->password = $password;
            $this->birthday = $birthday;
            $this->biography = $biography;
            $this->picture = $picture;

            $this->pdo = new Database("localhost", "root", "");
            $connect = $this->pdo->getConnect();

            try{
                $query = "INSERT INTO User(pseudo, email, password, birthday, Biography, picture) VALUES (? ? ? ? ? ?)";
                $exec = $connect->prepare($query);
                $exec->execute([$this->pseudo, $this->email, password_hash($this->password, PASSWORD_DEFAULT),
                $this->birthday,
                $this->biography,
                $this->picture]);
                
                echo "Un nouvel utilisateur ajouté";

            }catch(PDOException $exception){
                echo "L'insertion de l'utilisateur n'a pas fonctionné : ". $exception->getMessage();
            }

            $this->pdo = null;
        }
    }
?>
