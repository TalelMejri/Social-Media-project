<?php   
    class user_manager{
        
        private $pdo;
        public function __construct(){
            $this->pdo=new db_connect();
        }

        public function checkEmail(String $email){
            $sql = "SELECT * FROM users where email=:email";
            $query=$this->pdo->launchQuery($sql,['email'=>$email]);
            return $query->fetch();
        }

        public function signup(String $name,String $prenom,String $email,String $password,String $avatar,String $token,String $date){
            $sql="INSERT INTO `users`( `name`, `last_name`, `email`, `password`, `photo_user`, `token`, `verified`, `date_created`, `corbeille`, `role`)
                     VALUES (:name,:last,:email,:pass,:photo,:token,:verifier,:date,:corbe,:role)";
            $this->pdo->launchQuery($sql,[
                'name'=>$name,
                'last'=>$prenom,
                'email'=>$email,
                'pass'=>password_hash($password,PASSWORD_DEFAULT),
                'photo'=>$avatar,
                'token'=>$token,
                'verifier'=>0,
                'date'=>$date,
                'corbe'=>0,
                'role'=>0
            ]);
             $id_user=$this->pdo->lastInsertId();
             $sql="INSERT INTO visibilite_users (idUser,affichage,langue) VALUES (:id,:aff,:lang)";
             $this->pdo->launchQuery($sql,['id'=>$id_user,'aff'=>0,'lang'=>'en']);
             return $id_user;
        }

        public function validateUser_email(String $email,String $token){
            $sql="SELECT * from users where email=:email";
            $query=$this->pdo->launchQuery($sql,['email'=>$email]);
            $user=$query->fetch();
            try{
                 if($user){
                    if($user['verified']==1){
                        return 1;
                    }else{
                        if($token!=$user['token']){
                            return 2;
                        }
                        $sql="UPDATE users SET token=null,verified=1 where iduser=:id";
                        $this->pdo->launchQuery($sql,['id'=>$user['iduser']]);
                        return 3;
                    }
                }else{
                    return 0;
                }
             }
             catch(Exception $e){
                return 4;
            }
        }

        public function loginadmin(String $email,String $password){
            $sql="SELECT * from users where email=:email AND role=:role";
            $query=$this->pdo->launchQuery($sql,['email'=>$email,'role'=>1]);
            $user=$query->fetch();
            if(!$user){
                return 0;
            }else if(!password_verify($password,$user['password'])){
                return 0;
            }else{
                $_SESSION['id']=$user['iduser'];
                $_SESSION['name']=$user['name'];
                $_SESSION['lastname']=$user['lastname'];
                $_SESSION['email']=$user['email'];
                $_SESSION['password']=$user['password'];
                $_SESSION['avatar']=$user['photo_user'];
                return 1;
            }
        }
    
        public function loginUser(String $email,String $password){
            $sql="SELECT * from users where email=:email AND role=:role";
            $query=$this->pdo->launchQuery($sql,['email'=>$email,'role'=>0]);
            $user=$query->fetch();
            if(!$user){
                return 0;
            }else if(!password_verify($password,$user['password'])){
                return 0;
            }else if($user['verified']==0){
                return 2;
            }
            else{
                $_SESSION['idUser']=$user['iduser'];
                $_SESSION['nameUser']=$user['name'];
                $_SESSION['lastnameUser']=$user['last_name'];
                $_SESSION['emailUser']=$user['email'];
                $_SESSION['passwordUser']=$user['password'];
                $_SESSION['avatarUser']=$user['photo_user'];
                $_SESSION['dateUser']=$user['date_created'];
                return 1;
            }
        }

        public function addToken(int $id,String $token){
            $sql="UPDATE users SET token=:token where iduser=:id";
            $this->pdo->launchQuery($sql,['token'=>$token,'id'=>$id]);
        }

        public function countUser(){
            $sql="SELECT count(iduser) from users where role=0";
            $query=$this->pdo->launchQuery($sql);
            $value=$query->fetch();
            return $value['count(iduser)'];
        }

        public function addtoken_password(int $token,int $id){
            $sql="UPDATE users SET password_token=:token where iduser=:id";
            $this->pdo->launchQuery($sql,['token'=>$token,'id'=>$id]);
        }

        public function checkToken(String $email,int $code){
            $sql="SELECT  * from users where email=:email AND password_token=:code";
            $query=$this->pdo->launchQuery($sql,['email'=>$email,'code'=>$code]);
            return $query->fetch();
        }

        public function changerPassword(String $password,int $id){
            $sql="UPDATE users SET password=:pass where iduser=:id";
            $this->pdo->launchQuery($sql,
                [
                    'id'=>$id,
                    'pass'=>password_hash($password,PASSWORD_DEFAULT)
                ]
            );
        }

         public function getModeAffichage(int $id){
            $sql="SELECT affichage from  visibilite_users where idUser=:id";
            $query=$this->pdo->launchQuery($sql,['id'=>$id]);
            $value=$query->fetch();
            return $value['affichage'];
        }

         public function changer_visib(int $id){
            $chose=$this->getModeAffichage($id);
            $sql="UPDATE visibilite_users SET affichage=:aff where idUser=:id";
            $this->pdo->launchQuery($sql,['aff'=>!$chose,'id'=>$id]);
        }

         public function get_all_users(int $id){
            $sql="SELECT * from users where role=:role AND idUser!=:id";
            $query=$this->pdo->launchQuery($sql,['role'=>0,'id'=>$id]);
            return $query->fetchAll();
        }

         public function get_user(int $id){
            $sql="SELECT * from users where role=:role AND idUser=:id";
            $query=$this->pdo->launchQuery($sql,['role'=>0,'id'=>$id]);
            return $query->fetch();
        }

         public function Ajouter_ami(int $id1 ,int $id2){
            $sql="INSERT into friends (id_user1,id_user2,statu) VALUES (:id1,:id2,:statu)";
            $this->pdo->launchQuery($sql,['id1'=>$id1,'id2'=>$id2,'statu'=>0]);
        }

         public function check_friend_invi(int $id1 ,int $id2){
            $sql="SELECT * from friends where id_user1=:id1 AND id_user2=:id2 OR id_user1=:id2 AND id_user2=:id1 ";
            $query=$this->pdo->launchQuery($sql,['id1'=>$id1,'id2'=>$id2]);
            return $query->fetch();
        }

         public function get_invi_user(int $id1){
            $sql="SELECT * from friends where id_user2=:id1 and  statu=:st";
            $query= $this->pdo->launchQuery($sql,['id1'=>$id1,'st'=>0]);
            return $query->fetchAll();
        }

         public function accepter_ami(int $id1 ,int $id2){
            $sql="UPDATE friends SET statu=:st where id_user1=:id1 and id_user2=:id2";
            $this->pdo->launchQuery($sql,['st'=>1,'id1'=>$id1,'id2'=>$id2]);
        }

         public function add_notification(int $id,String $desc){
            $sql="INSERT INTO notification (id_user_current,description) VALUES (:id,:notif)";
            $this->pdo->launchQuery($sql,['id'=>$id,'notif'=>$desc]);
        }

         public function get_notif(int $id){
            $sql="SELECT * from notification where id_user_current=:id";
            $query=$this->pdo->launchQuery($sql,['id'=>$id]);
            return $query;
        }

         public function lenght_notif(int $id){
            $sql="SELECT count(id) from notification where id_user_current=:id";
            $query=$this->pdo->launchQuery($sql,['id'=>$id]);
            $value=$query->fetch();
            return $value['count(id)'];
         }

         public function delete_notif_by_id(int $id){
            $sql="DELETE from notification where id=:id";
            $this->pdo->launchQuery($sql,['id'=>$id]);
         }

         public function get_all_friend(int $id){   
            $sql="SELECT DISTINCT u.* from users u,friends f where u.iduser=f.id_user1 Or u.iduser=f.id_user2 and u.iduser!=$id and f.statu=1";
            $query=$this->pdo->launchQuery($sql);
            return $query->fetchAll();
         }

         public function get_user_filter_friend(int $id,int $id2){
            $sql="SELECT * from friends where (id_user1=$id and id_user2=$id2 and statu=1) or (id_user1=$id2 and id_user2=$id and statu=1) ";
            $query=$this->pdo->launchQuery($sql);
             $verifier=$query->fetch();
             if($verifier){
                return true;
             }else{
                return false;
             }
         }
       
         public function get_friend(int $id,String $name){
            $ami="%".$name."%";
            $sql="SELECT * from users u,friends f where u.iduser=f.id_user1  and u.name like :ami Or u.iduser=f.id_user2 and u.iduser!=$id and f.statu=1 and u.name like :ami";
            $query=$this->pdo->launchQuery($sql,['ami'=>$ami]);
            return $query->fetchAll();
         }

         public function addComment(int $id,String $desc,int $pub){
            $sql="INSERT INTO comments (id_user,description,idpub) VALUES (:id,:desc,:idpub)";
            $this->pdo->launchQuery($sql,['id'=>$id,'desc'=>$desc,'idpub'=>$pub]);
        } 

        public function get_comment_idpub(int $id){
            $sql="SELECT * from comments c,users u where c.id_user=u.iduser and c.idpub=:id";
            $query=$this->pdo->launchQuery($sql,['id'=>$id]);
            return $query->fetchAll();
        }

        public function update_comment(int $idcomment,String $desc){
            $sql="UPDATE comments SET description=:desc where id_comments=:id";
            $this->pdo->launchQuery($sql,['id'=>$idcomment,'desc'=>$desc]);
        }

        public function somme_comment_by_id_pub(int $id_pub){
            $sql="SELECT count(idpub) from comments where idpub=:id";
            $user=$this->pdo->launchQuery($sql,['id'=>$id_pub]);
            $value=$user->fetch();
            return $value['count(idpub)'];
        }

        public function delete_comment(int $idcomment){
            $sql="DELETE from comments where id_comments=:id";
            $this->pdo->launchQuery($sql,['id'=>$idcomment]);
        }

        public function check_comment(int $iduser,int $idcomment,int $idpub){
            $sql="SELECT * from comments where id_comments=:idcom and id_user=:iduser and idpub=:idpub";
            $user=$this->pdo->launchQuery($sql,['idcom'=>$idcomment,'iduser'=>$iduser,'idpub'=>$idpub]);
            return $user;
        }

        public function get_iduser_byidpub_created(int $idpub,int $iduser){
            $sql="SELECT * from pub p,users u  where p.id_user=u.iduser and u.iduser=:iduser and p.id=:idpub";
            $user=$this->pdo->launchQuery($sql,['idpub'=>$idpub,'iduser'=>$iduser]);
            return $user->fetch();
        }
        
        public function get_user_liked(int $id,int $idpub){
            $sql="SELECT * from like_pub where id_user=:id AND id_pub=:id_pub";
            $query= $this->pdo->launchQuery($sql,['id'=>$id,'id_pub'=>$idpub]);
            $verified= $query->fetch();
            if(!$verified){
                return false;
            }
            return true;
        }

        public function somme_like(int $id){
            $sql="SELECT sum(liked) from like_pub where id_pub=:id";
            $query=$this->pdo->launchQuery($sql,['id'=>$id]);
            $value=$query->fetch();
            return $value['sum(liked)'];
        }

        public function get_pub_byiduser_idpub(int $id,int $idpub){
            $sql="SELECT * from save where id_user=:id AND id_pub=:idpub";
            $query= $this->pdo->launchQuery($sql,['id'=>$id,'idpub'=>$idpub]);
            $verified= $query->fetch();
            if(!$verified){
                return false;
            }
            return true;
        }

        public function get_user_liked_pub(int $idpub){
            $sql="SELECT u.name,u.photo_user from users u,like_pub l where l.id_user=u.iduser and l.id_pub=:id and l.liked=1";
            $query=$this->pdo->launchQuery($sql,['id'=>$idpub]);
            return $query->fetchAll();
        }

        public function name_user_like_pub(int $idpub){
            $sql="SELECT u.name from users u,like_pub l where l.id_user=u.iduser and l.id_pub=:id and l.liked=1 limit 1";
            $query=$this->pdo->launchQuery($sql,['id'=>$idpub]);
            return $query->fetch();
        }

        public function send_message(int $idenvoi,int $idrecu,String $message){
            $date= date('d/m/y');
            $sql="INSERT INTO chat (id_envoi,id_recu,message,date) VALUES (:idenvoi,:idrecu,:message,:date)";
            $this->pdo->launchQuery($sql,[
                'idenvoi'=>$idenvoi,
                'idrecu'=>$idrecu,
                'message'=>$message,
                'date'=>$date
            ]);
        }

    }
?>