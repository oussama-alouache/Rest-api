<?php 
class Voiture 
{
    private $conn;
    private $table_name = "voiture";

    public $id;
    public $nom;
    public $id_marque;
    public $id_model;
    public $matricule;
    public $km;
    public $etat;
 
    public $path;

    public function __construct($db){
        $this->conn = $db;
    }

                function show (){ // afichher tout les utilisaeur

                    $sql = "SELECT
                     m.nom_marque as nom_marque, l.nom_model as nom_model, v.id, v.nom, v.id_marque, v.id_model, v.matricule, v.created_at,v.updatted_at,km,etat
                    FROM
                    voiture v
                    LEFT JOIN
                    marque m
                    ON v.id_marque = m.id
                    LEFT JOIN
                    model l
                    ON v.id_model = l.id
                    ORDER BY
                    v.created_at DESC";
            
            $stmt = $this->conn->prepare($sql);
                    
                 
            $stmt->execute();
        
            return $stmt;
        }
        
        

                 
                 
          
                
                function save (){ // Iinser tout les utilisaeur

            


                     $sql =  "INSERT INTO
                                 voiture
                                SET
                                    nom=:nom,
                                    id_marque=:id_marque,
                                    id_model=:id_model, 
                                    matricule=:matricule, 
                                    created_at=:created_at,
                                    km=:km,
                                    etat=:etat
                                    ";
                       
          




                             $stmt = $this->conn->prepare($sql);


                             $this->nom=htmlspecialchars(strip_tags($this->nom));
                             
                             $this->id_marque=htmlspecialchars(strip_tags($this->id_marque));
                             
                             $this->id_model=htmlspecialchars(strip_tags($this->id_model));
                             $this->matricule=htmlspecialchars(strip_tags($this->matricule));
                             $this->created_at=htmlspecialchars(strip_tags($this->created_at));
                             $this->km=htmlspecialchars(strip_tags($this->km));
                             $this->etat=htmlspecialchars(strip_tags($this->etat));
                         


                             $stmt->bindParam(":nom", $this->nom);
                             $stmt->bindParam(":id_marque", $this->id_marque);
                             $stmt->bindParam(":id_model", $this->id_model);
                             $stmt->bindParam(":matricule", $this->matricule);
                             $stmt->bindParam(":created_at", $this->created_at);
                             $stmt->bindParam(":km", $this->km);
                             $stmt->bindParam(":etat", $this->etat);
                     

                             if($stmt->execute()){
                                 return true;
                             }
                         
                             return false;
                                      

                            
                   
                }

                public function edit(){
                 
                    $sql = "SELECT
                     m.nom_marque as nom_marque, l.nom_model as nom_model, v.id, v.nom, v.id_marque, v.id_model, v.matricule, v.created_at,v.updatted_at,km,etat
                    FROM
                    voiture v
                    LEFT JOIN
                    marque m
                    ON v.id_marque = m.id
                    LEFT JOIN
                    model l
                    ON v.id_model = l.id
                     WHERE  v.id = ? LIMIT 0,1";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(1, $this->id);
                    $stmt->execute();
                    $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    $this->id = $dataRow['id'];
                    $this->nom = $dataRow['nom'];
                    $this->id_marque = $dataRow['id_marque'];
                    $this->id_model = $dataRow['id_model'];
                    $this->matricule = $dataRow['matricule'];
                    $this->nom_marque = $dataRow['nom_marque'];
                    $this->nom_model = $dataRow['nom_model'];
                    $this->created_at = $dataRow['created_at'];
                    $this->updatted_at = $dataRow['updatted_at'];
                    $this->km = $dataRow['km'];
                    $this->etat = $dataRow['etat'];
          
                }        

           
                public function update()// modifer  un   utilisaeur
                {
                  
                 
                    $sql =  "UPDATE 
                    voiture
                   SET
                       nom=:nom,
                       id_marque=:id_marque,
                       id_model=:id_model,
                       matricule=:matricule,
                       updatted_at=:updatted_at,
                       km=:km,
                       etat=:etat
                        WHERE id=:id ";

                        
                    $stmt = $this->conn->prepare($sql);

                    $this->id=htmlspecialchars(strip_tags($this->id));
                    $this->nom=htmlspecialchars(strip_tags($this->nom));
                             
                    $this->id_marque=htmlspecialchars(strip_tags($this->id_marque));
                    
                    $this->id_model=htmlspecialchars(strip_tags($this->id_model));
                    $this->matricule=htmlspecialchars(strip_tags($this->matricule));
                    $this->updatted_at=htmlspecialchars(strip_tags($this->updatted_at));
                    $this->km=htmlspecialchars(strip_tags($this->km));
                    $this->etat=htmlspecialchars(strip_tags($this->etat));
               


                    $stmt->bindParam(":id", $this->id);
                    $stmt->bindParam(":nom", $this->nom);
                    $stmt->bindParam(":id_marque", $this->id_marque);
                    $stmt->bindParam(":id_model", $this->id_model);
                    $stmt->bindParam(":matricule", $this->matricule);
                    $stmt->bindParam(":updatted_at", $this->updatted_at);
                    $stmt->bindParam(":km", $this->km);
                    $stmt->bindParam(":etat", $this->etat);
                 
                   
                    if($stmt->execute()){
                        return true;
                    }
                
                    return false;
                             
                }
                
              public function destroy() // supprimer
              {
                $sql = "DELETE FROM voiture  WHERE id = ?";
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