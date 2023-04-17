<?php 
class Reservation 
{
    private $conn;
    private $table_name = "reservation";

    public $id;
    public $id_user;
    public $id_voiture;
    public $created_at;


    public function __construct($db){
        $this->conn = $db;
    }

                function show (){ // afichher tout les utilisaeur

                    $sql = "SELECT
                    v.nom as nomv , v.matricule as matricule, r.id, r.nom,r.prenom,r.adresse, r.mail,r.phone,r.id_voiture, r.created_at
                    FROM
                    reservation r
                    LEFT JOIN
                    voiture v
                    ON r.id_voiture = v.id";
                    
                    // prepare query statement
                    $stmt = $this->conn->prepare($sql);
                    // execute query
                    $stmt->execute();
                    return $stmt;
                }


                
                function save (){ // Iinser tout les utilisaeur

                     $sql =  "INSERT INTO
                     " . $this->table_name . "
                                SET
                                    nom=:nom,
                                    prenom=:prenom,
                                    adresse=:adresse,
                                    mail=:mail,
                                    phone=:phone,
                                    id_voiture=:id_voiture,
                                    created_at=:created_at";
                       

                             $stmt = $this->conn->prepare($sql);

                             $this->nom=htmlspecialchars(strip_tags($this->nom));
                             $this->prenom=htmlspecialchars(strip_tags($this->prenom));
                             $this->adresse=htmlspecialchars(strip_tags($this->adresse));
                             $this->mail=htmlspecialchars(strip_tags($this->mail));
                             $this->phone=htmlspecialchars(strip_tags($this->phone));
                             $this->id_voiture=htmlspecialchars(strip_tags($this->id_voiture));
                             $this->created_at=htmlspecialchars(strip_tags($this->created_at));



                
                             $stmt->bindParam(":nom", $this->nom);
                             $stmt->bindParam(":prenom", $this->prenom);
                             $stmt->bindParam(":adresse", $this->adresse);
                             $stmt->bindParam(":mail", $this->mail);
                             $stmt->bindParam(":phone", $this->phone);
                             $stmt->bindParam(":id_voiture", $this->id_voiture);
                             $stmt->bindParam(":created_at", $this->created_at);
                          

                             if($stmt->execute()){
                                 return true;
                             }
                         
                             return false;
                                      

               
                   
                }

                public function edit(){
                    $sql = "SELECT
                    v.nom as nom , v.matricule as matricule, r.id, r.nom,r.prenom,r.adresse, r.mail,r.phone,r.id_voiture, r.created_at
                    FROM
                    reservation r
                    LEFT JOIN
                    voiture v
                    ON r.id_voiture = v.id
                    
                     WHERE  r.id = ? LIMIT 0,1";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(1, $this->id);
                    $stmt->execute();
                    $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    
                    $this->nom = $dataRow['nom'];
                    $this->prenom = $dataRow['prenom'];
                    $this->adresse = $dataRow['adresse'];
                    $this->mail = $dataRow['mail'];
                    $this->phone = $dataRow['phone'];
                    
                    $this->id_voiture = $dataRow['id_voiture'];
                    $this->nom = $dataRow['nom'];
                    $this->matricule = $dataRow['matricule'];
                    $this->created_at = $dataRow['created_at'];
                    $this->updatted_at = $dataRow['updatted_at'];
                }        

                
                 
                public function destroy() // supprimer
                {
                  $sql = "DELETE FROM reservation  WHERE id = ?";
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