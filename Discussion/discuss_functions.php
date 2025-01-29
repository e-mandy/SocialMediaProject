<?php
 require_once '../Database/connection.php';
class Discussion{
    private $pdo;

    public function __construct($idReceiver){
        //Le code de création d'une discussion
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
}

?>