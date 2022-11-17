 <?php
     require_once "db_connect.php";
     
     class File{

        private $filename;
        private $storage_directory;
        private $file_type;
        private $tmp_directory;
        private $size_file;
        /* constructeur avec parametre pour initialiser tous le attribuits avec chaque instancd */
        public function  __construct(String $storage_personnel,array $info_file){
            $this->filename=$info_file['name'];
            $this->storage_directory=$storage_personnel;
            $this->file_type=pathinfo($this->filename,PATHINFO_EXTENSION);
            $this->tmp_directory=$info_file['tmp_name'];
            $this->size_file=$info_file['size'];
         }
         /** upload image */
         public function uploadImage(){
            $this->filename=md5(rand()).'.'.$this->file_type;
            if(!move_uploaded_file($this->tmp_directory,$this->storage_directory.$this->filename)){
                return false;
            }
            return true;
         }
        /* get name car name:private */
         public function getfilename():String{
            return $this->filename;
         }
   /* verifier c'est que image ( jpg,png,svg,jpeg)*/
          public function isimage(){
            $array_image_dispo=['JPG','PNG','JPEG','SVG'];
            if(!in_array(strtoupper($this->filetype),$array_image_dispo)){
                return false;
            }else{
                return true;
            }
         }

   /* verifier size inferieur a 999999999*/
         public function size(){
            if($this->size_file>99999999999){
                return false;
            }
            return true;
         }

         
    } 

 ?>