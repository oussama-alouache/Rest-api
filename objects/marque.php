<?php 


class Marque 
{
    private $conn;
    private $table_name = "marque";

    public $id;
    public $nom_marque;
    public $created_at;


    public function __construct($db){
        $this->conn = $db;
    }

                function show (){ // afichher tout les utilisaeur

                    $sql = "SELECT * FROM marque";
                 

                    $stmt = $this->conn->prepare($sql);
                    
                 
                    $stmt->execute();
                
                    return $stmt;
                }
                

                




                
                function save (){ // Iinser tout les utilisaeur

                     $sql =  "INSERT INTO
                     " . $this->table_name . "
                                SET
                                    nom_marque=:nom_marque,
                                    created_at=:created_at";
                       

                             $stmt = $this->conn->prepare($sql);

                             $this->nom_marque=htmlspecialchars(strip_tags($this->nom_marque));
                             $this->created_at=htmlspecialchars(strip_tags($this->created_at));



                             $stmt->bindParam(":nom_marque", $this->nom_marque);
                             $stmt->bindParam(":created_at", $this->created_at);
                          

                             if($stmt->execute()){
                                 return true;
                             }
                         
                             return false;
                                      

               
                   
                }

                public function edit(){
                    $sqlQuery = "SELECT * FROM marque WHERE  id = ? LIMIT 0,1";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->id);
                    $stmt->execute();
                    $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    
                    $this->nom_marque = $dataRow['nom_marque'];
                    $this->created_at = $dataRow['created_at'];
                    $this->updatted_at = $dataRow['updatted_at'];
                }        


           
           
                public function update()// modifer  un   utilisaeur
                {
                

                    $sql = "UPDATE marque  SET
                      nom_marque=:nom_marque,
             
                    updatted_at=:updatted_at

                      WHERE
                       id=:id ";
                       

                    $stmt = $this->conn->prepare($sql);

                    $this->id=htmlspecialchars(strip_tags($this->id));
                    $this->nom_marque=htmlspecialchars(strip_tags($this->nom_marque));
                 
                    $this->updatted_at=htmlspecialchars(strip_tags($this->updatted_at));


                    $stmt->bindParam(":id", $this->id);
                    $stmt->bindParam(":nom_marque", $this->nom_marque);

                    $stmt->bindParam(":updatted_at", $this->updatted_at);
                 

                    if($stmt->execute()){
                        return true;
                    }
                
                    return false;
                }
                
                
              public function destroy() // supprimer
              {
                $sql = "DELETE FROM marque  WHERE id = ?";
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