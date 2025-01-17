<?php
    class login{
        private $connect;

        // Constructeur pour établir la connexion à la base de données
        public function __construct($connect) {
            $this->connect = $connect;
        }
        //Fonction pour la connexion
        public function login($email) {
            $email=filter_var($_POST['email']);
            $password= password_hash($_POST['password'], PASSWORD_BCRYPT);
            $req = $this->connect->prepare("SELECT * FROM user WHERE email = :email");
            $req->bindParam(':email', $email);
            $req->execute();
            $user = $req->fetch(PDO::FETCH_ASSOC);
        
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                return true;
            }
            return false;
        }
        
        public function isLoggedIn() {
            return isset($_SESSION['user_id']);
        }
        
        public function logout() {
            session_destroy();
        }
                
    }
?>