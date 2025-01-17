<?php

class Database{
    private $dbname = "socialmedia";
    private $dbhost;
    private $dbpassword;
    private $dbuser;
    private $connect;

    public function __construct($dbhost, $dbuser, $dbpassword){
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpassword = $dbpassword;
    }

    public function getConnect(){
        $this->connect = null;

        try{
            $this->connect = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname}",
            $this->dbuser,
            $this->dbpassword
            );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "La connexion a réussi :)";

        }catch(PDOException $exception){
            echo "La connexion a echoué : ". $exception->getMessage();
        }

        return $this->connect;
    }
}

?>

