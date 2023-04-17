<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *'); header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, PATCH, DELETE'); header('Access-Control-Allow-Headers: Content-Type') ;
class Model 

{
    private $conn;
    private $table_name = "model";

    public $id;
    public $nom_model;
    public $created_at;
    public $updatted_at;

    public function __construct($db){
        $this->conn = $db;
    }

                function show (){ // afichher tout les utilisaeur

                    $sql = "SELECT * FROM model ";
                 

                    $stmt = $this->conn->prepare($sql);
                    
                 
                    $stmt->execute();
                
                    return $stmt;
                }
                
               

                
                function save (){ // Iinser tout les utilisaeur

                     $sql =  "INSERT INTO
                     " . $this->table_name . "
                                SET
                                nom_model=:nom_model,
                                created_at=:created_at";
                       

                             $stmt = $this->conn->prepare($sql);

                             $this->nom_model=htmlspecialchars(strip_tags($this->nom_model));
                             $this->created_at=htmlspecialchars(strip_tags($this->created_at));



                             $stmt->bindParam(":nom_model", $this->nom_model);
                             $stmt->bindParam(":created_at", $this->created_at);
                          

                             if($stmt->execute()){
                                 return true;
                             }
                         
                             return false;
                                      

               
                   
                }

                public function edit(){
                    $sqlQuery = "SELECT * FROM model WHERE  id = ? ";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->id);
                    $stmt->execute();
                    $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    
                    $this->nom_model = $dataRow['nom_model'];
                    $this->created_at = $dataRow['created_at'];
          
                }        


           
                public function update()// modifer  un   utilisaeur
                {
                

                    $sql = "UPDATE model SET 
             
                                nom_model=:nom_model,
                                updatted_at=:updatted_at
              
                      WHERE
                       id=:id ";
                       
                    $stmt = $this->conn->prepare($sql);
                    $this->id=htmlspecialchars(strip_tags($this->id));
                    $this->nom_model=htmlspecialchars(strip_tags($this->nom_model));
                    $this->updatted_at=htmlspecialchars(strip_tags($this->updatted_at));
               


                    $stmt->bindParam(":id", $this->id);

                    $stmt->bindParam(":nom_model", $this->nom_model);
                    
                    $stmt->bindParam(":updatted_at", $this->updatted_at);
      
                    
                 

                    if($stmt->execute()){
                        return true;
                    }
                
                    return false;
                }
                
              public function destroy() // supprimer
              {
                $sql = "DELETE FROM model  WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
            
                $this->id=htmlspecialchars(strip_tags($this->id));
            
                $stmt->bindParam(1, $this->id);
            
                if($stmt->execute()){
                    return true;
                }
                return false;
            
        
   }


}






?>