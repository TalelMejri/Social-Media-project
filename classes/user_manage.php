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
            return $this->pdo->lastInsertId();
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

    }
?>