<?php
require_once '../Database/connection.php';
class Discussion{
    private $pdo;

    public function __construct($idCurrentUser, $idReceiver){
        $this->pdo = new Database("localhost", "root", "");
        $connect = $this->pdo->getConnect();
        try{
            $query = "INSERT INTO Discussion (currentuser_id, id_receiver) VALUES (? ?)";
            $exec = $connect->prepare($query);
            $exec->execute([$idCurrentUser, $idReceiver]);
        }catch(PDOException $exception){
            echo "Erreur : ". $exception;
        }
        
    }

    public static function getAll($current_id){
        $pdo = new Database("localhost", "root", "");
        $connect = $pdo->getConnect();
        try{
            $request = "SELECT id_receiver, pseudo
                        FROM discussion, user
                        WHERE Discussion.currentuser_id = ? AND Discussion.id_receiver = User.id";
            
            $exec = $connect->prepare($request);
            $exec->execute([$current_id]);
            
            $value = $exec->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $exception){
            echo "Erreur  : ". $exception;
        }

        return $value;
    }

    public function delete($idDisussion){
        if($this->pdo = null){
            $this->pdo = new Database("localhost", "root", "");
        }
        
        $connect = $this->pdo->getConnect();

        try{
            $query = "DELETE FROM Discussion WHERE id = ?";
            $exec = $connect->prepare($query);
            $exec->execute([$idDisussion]);
        }catch(PDOException $exception){
            echo "Erreur : ". $exception;
        }
    }
}

?>
