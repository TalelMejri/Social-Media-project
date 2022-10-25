<?php 

    class manage_user{
        private $pdo;
        public function __construct()
        {
            $this->pdo=new db_connect();  
        }

        public function get_alluser(){
            $sql = "SELECT * FROM users where name=:name_user";
            $query = $this->pdo->prepare($sql);
            $query->execute(['name_user'=>"mejri"]);
            return $query->fetchAll();
        }
    }



?>