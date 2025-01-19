<?php
class auth{
    private $connect;

    // Constructeur pour établir la connexion à la base de données
        $this->connect = $connect;
    }

    // Fonction pour valider les données de l'inscription
    public function validateInput($data){
        $errors = [];

        // Vérifier le nom d'utilisateur
        if (empty($data['username'])) {
            $errors[] = "Le nom d'utilisateur est requis.";
        }

        // Vérifier l'email
        if (empty($data['email'])) {
            $errors[] = "L'email est requis.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email n'est pas valide.";
        }

        // Vérifier le mot de passe
        if (empty($data['password'])) {
            $errors[] = "Le mot de passe est requis.";
        } elseif (strlen($data['password']) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
        }

        // Vérifier la date de naissance
        if (empty($data['birthday'])) {
            $errors[] = "Mentionner votre date de naissance";
         }
        
                // Vérifier le mot de passe
        if (empty($data['password'])) {
            $errors[] = "Le mot de passe est requis.";
        } elseif (strlen($data['password']) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
        }

        // Vérifier la biographie
        if (empty($data['biography'])) {
            $errors[] = "Faite une petite description sur vous";
        }
        
        // Vérifier l'image'
        if (empty($data['picture'])) {
            $errors[] = "L'image est requise";
        }
         return $errors;
    }

    // Fonction pour insérer l'utilisateur dans la base de données
    public function register($data) {
        // Hashage du mot de passe
        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        
        //Empecher les failles XSS
        $username=htmlspecialchars($data['username']);

        // Préparer et exécuter la requête d'insertion
        $req = $this->connect->prepare("INSERT INTO user (pseudo, email, password,birthday,Biography,picture) VALUES (?, ?, ?,?, ?, ?)");
        $result=$req->execute(array($username, $data['email'], $hashedPassword, $data['birthday'], $data['Biography'], $data['picture']));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction pour la connexion de l'utilisateur
    /*public function login($data){

  }*/
}





// Inclure les fichiers nécessaires
require_once '../Database/connection.php';
require_once 'auth.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $data = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'birthday' => $_POST['birthday'],
        'Biography' => $_POST['Biography'],
        'picture' => $_FILES['picture'],
    ];

    // Créer une instance de la classe authentification
    $signUp = new auth($connect);

    // Valider les données
    $errors = $signUp->validateInput($data);

    // Si il y a des erreurs, afficher les erreurs
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
        // Si les données sont valides, essayer de les enregistrer
        if ($signUp->register($data)) {
            echo "Inscription réussie !";
        } else {
            echo "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
        }
    }
}
?>



 