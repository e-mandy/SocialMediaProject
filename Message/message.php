<?php

class Message{
    private $pdo;
    private $text = null;
    private $image = null;
    private $idSender;


    public function __construct($idSender, $idDiscussion, $text = null, $image = null){
        $this->text = $text;
        $this->image = $image;
        $this->idSender = $idSender;

        if($this->pdo = null){
            $this->pdo = new Database("localhost", "root", "");
        }
        $connect = $this->pdo->getConnect();

        try{
            $query = "INSERT INTO Message (id_sender, text, image, id_discussion, date) VALUES (? ? ? ? ?)";
            $exec = $connect->prepare($query);
            $exec->execute([$idSender, htmlspecialchars($text), $image, $idDiscussion, date("H-i-s d/m/Y")]);

        }catch(PDOException $exception){
            echo "Erreur : ". $exception;
        }
    }

    public static function getAll($idDiscussion){
        $pdo = new Database("localhost", "root", "");
        $connect = $pdo->getConnect();

        try{
            $query = "SELECT id_sender, text, image, date
                    FROM Message WHERE id_discussion = ?";
            
            $exec = $connect->prepare($query);
            $exec->execute([$idDiscussion]);

            $values = $exec->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $exception){
            echo "Erreur : ". $exception;
        }

        return $values;
    }

    public function delete($idMessage){
        if($this->pdo = null){
            $this->pdo = new Database("localhost", "root", "");
        }

        $connect = $this->pdo->getConnect();
        
        try{
        $query = "DELETE FROM Message WHERE id = ?";
        $exec = $connect->prepare($query);
        $exec->execute([$idMessage]);
        
        }catch(PDOException $exception){
            echo "Erreur : ". $exception;
        }
    }
}

?>
