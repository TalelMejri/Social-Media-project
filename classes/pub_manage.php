<?php 
     
    class pub_manage{
        
        private $pdo;
        public function __construct(){
            $this->pdo=new db_connect();
        }


        public function Add_Story(String $file,int $id,String $date){
            $sql="INSERT INTO story (file,id_user,created_at) VALUES (:file,:id,:date)";
            $this->pdo->launchQuery($sql,['file'=>$file,'id'=>$id,'date'=>$date]);
         }

   

         public function addPub(String $date,String $desc,String $avatar='',int $id,String $theme=''){
            $sql="INSERT INTO pub ( `date`, `description`, `avatar`,`theme`, `id_user`) VALUES(:date,:desc,:avatar,:theme,:id)";
             $this->pdo->launchQuery($sql,[
                'date'=>$date,
                'desc'=>$desc,
                'avatar'=>$avatar,
                'theme'=>$theme,
                'id'=>$id
             ]);
            return $this->pdo->lastInsertId();
         }

      
        public function AddlikePub(int $idpub,int $iduser){
            $sql="SELECT * from like_pub where id_user=:id AND id_pub=:idpub";
            $query= $this->pdo->launchQuery($sql,['id'=>$iduser,'idpub'=>$idpub]);
            $user=$query->fetch();
            if(!$user){
                $sql="INSERT INTO like_pub (id_user,id_pub,liked) VALUES (:iduser,:id_pub,:liked)";
                $this->pdo->launchQuery($sql,['iduser'=>$iduser,'id_pub'=>$idpub,'liked'=>true]);
            }else{
                /*$sql="UPDATE like_pub SET liked=:liked_new where id_pub=:id_pub AND id_user=:id_user";
                $this->pdo->launchQuery($sql,['liked_new'=>!$user['liked'],'id_pub'=>$idpub,'id_user'=>$iduser]);*/
                $sql="DELETE from like_pub where id_pub=:id_pub AND id_user=:id_user ";
                $this->pdo->launchQuery($sql,['id_pub'=>$idpub,'id_user'=>$iduser]);
            }
        }

      

     

        public function save_pub(int $id,int $idpub){
            $sql="SELECT * from save where id_user=:id AND id_pub=:idpub";
            $query= $this->pdo->launchQuery($sql,['id'=>$id,'idpub'=>$idpub]);
            $user=$query->fetch();
            if(!$user){
                $sql="INSERT INTO save (id_user,id_pub) VALUES (:iduser,:id_pub)";
                $this->pdo->launchQuery($sql,['iduser'=>$id,'id_pub'=>$idpub]);
            }else{
                $sql="DELETE from save where id_pub=:id_pub AND id_user=:id_user ";
                $this->pdo->launchQuery($sql,['id_pub'=>$idpub,'id_user'=>$id]);
            }
        }

        public function deletePubSave(int $id){
            $sql="DELETE from save where id=:id";
            $this->pdo->launchQuery($sql,['id'=>$id]);
        }

        public function get_pub(int $id){
            $sql="SELECT * from pub where id=:id";
            $query= $this->pdo->launchQuery($sql,['id'=>$id]);
            return $query->fetch();
        }

        public function get_all_pub_save(int $id){
            $sql="SELECT * from save where id_user=:id";
            $query=$this->pdo->launchQuery($sql,['id'=>$id]);
            return $query->fetchAll();
        }

        public function edit_pub(int $id,int $idpub,String $avatar='',String $theme,String $desc,){
                if($avatar==''){
                    $sql="UPDATE pub SET theme=:theme,description=:desc where id=:id and id_user=:id_user";
                    $this->pdo->launchQuery($sql,[
                        'id'=>$idpub,
                        'id_user'=>$id,
                        'theme'=>$theme,
                        'desc'=>$desc
                    ]);
                }else{
                    $sql="UPDATE pub SET theme=:theme,avatar=:avatar,description=:desc where id=:id and id_user=:id_user";
                    $this->pdo->launchQuery($sql,[
                        'id'=>$idpub,
                        'id_user'=>$id,
                        'theme'=>$theme,
                        'avatar'=>$avatar,
                        'desc'=>$desc
                    ]);
                }  
        }


        public function deletePub(int $id){
            $sql="DELETE from pub where id=:id";
            $this->pdo->launchQuery($sql,['id'=>$id]);
        }

        public function get_messages(int $idenvoi,int $idrecu){
            $sql="SELECT * from chat  where id_envoi=:idenvoi  and id_recu=:idrecu or id_envoi=:idrecu and  id_recu=:idenvoi";
            $query=$this->pdo->launchQuery($sql,[
                'idenvoi'=>$idenvoi,
                'idrecu'=>$idrecu
            ]);
            return $query->fetchAll();
        }

      
       

        

    }


    ?>