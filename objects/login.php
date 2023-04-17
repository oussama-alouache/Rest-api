<?php 
class Login 
{
    private $conn;
    private $table_name = "user";

    public $id;
    public $email;
    public $password;


function __construct($db){
        $this->conn = $db;
    }
     function login(){
        $sqlQuery = "SELECT * FROM user WHERE  email= ? and password = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->password=htmlspecialchars(strip_tags($this->password));
 

        $this->email=htmlspecialchars(strip_tags($this->email));

         $passwrod = password_verify($this->password,PASSWORD_BCRYPT);


        $stmt->bindParam(":email", $this->email);

        $stmt->bindParam(":email",  $passwrod);
    
        $stmt->execute(array($this->email, $passwrod));
        $mainCount=$stmt->rowCount();
        $userData = $stmt->fetch(PDO::FETCH_OBJ);
  if(!empty($userData))
  {
       $user_id=$userData->user_id;
       $userData->token = apiToken($user_id);
  }
      $db = null;
  if($userData){
     $userData = json_encode($userData);
     echo '{"userData": ' .$userData . '}';
  } else {
     echo '{"error":{"text":"Bad request wrong username and password"}}';
  }
  
  }
 
        


       


        
   }









?>