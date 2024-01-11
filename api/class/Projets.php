<?php
    class Projets{

        // Connection
        private $conn;

        // Table
        private $db_table = "projets";

        // Columns
        public $id_projet;
        public $filiere;
        public $description;
        public $titre;
        public $lien;
        public $illustration;
 
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getProjets(){
            $sqlQuery = "SELECT id_projet, filiere, description, titre, lien, illustration FROM " . $this->db_table . "";
            $stmt_Projets = $this->conn->prepare($sqlQuery);
            $stmt_Projets->execute();
            return $stmt_Projets;
        }

        // CREATE
        public function createProjets(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET  
                        filiere = :filiere,
                        description = :description,
                        titre = :titre,
                        lien = :lien,
                        illustration = :illustration";
        
            $stmt_Projets = $this->conn->prepare($sqlQuery);
        
            // Sanitize
            $this->filiere=htmlspecialchars(strip_tags($this->filiere));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->titre=htmlspecialchars(strip_tags($this->titre));
            $this->lien=htmlspecialchars(strip_tags($this->lien));
            $this->illustration=htmlspecialchars(strip_tags($this->illustration));
        
            // Bind data
            $stmt_Projets->bindParam(":filiere", $this->filiere);
            $stmt_Projets->bindParam(":description", $this->description);
            $stmt_Projets->bindParam(":titre", $this->titre);
            $stmt_Projets->bindParam(":lien", $this->lien);
            $stmt_Projets->bindParam(":illustration", $this->illustration);
        
            if($stmt_Projets->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleProjets(){
            $sqlQuery = "SELECT
                        id_projet, 
                        filiere,
                        description,
                        titre,
                        lien,
                        illustration
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_projet = ?
                    LIMIT 0,1";
            $stmt_Projets = $this->conn->prepare($sqlQuery);
            $stmt_Projets->bindParam(1, $this->id_projet);
            $stmt_Projets->execute();
            $dataRow = $stmt_Projets->fetch(PDO::FETCH_ASSOC);
            
            $this->id_projet = $dataRow['id_projet'];
            $this->filiere = $dataRow['filiere'];
            $this->description = $dataRow['description'];
            $this->titre = $dataRow['titre'];
            $this->lien = $dataRow['lien'];
            $this->illustration = $dataRow['illustration'];
        }   

        // UPDATE
        public function updateProjets(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET 
                        filiere = :filiere,
                        description = :description,
                        titre = :titre,
                        lien = :lien,
                        illustration = :illustration
                    WHERE 
                        id_projet = :id_projet";
        
            $stmt_Projets = $this->conn->prepare($sqlQuery);
        
            $this->filiere=htmlspecialchars(strip_tags($this->filiere));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->titre=htmlspecialchars(strip_tags($this->titre));
            $this->lien=htmlspecialchars(strip_tags($this->lien));
            $this->illustration=htmlspecialchars(strip_tags($this->illustration));
        
            // Bind data
            $stmt_Projets->bindParam(":filiere", $this->filiere);
            $stmt_Projets->bindParam(":description", $this->description);
            $stmt_Projets->bindParam(":titre", $this->titre);
            $stmt_Projets->bindParam(":lien", $this->lien);
            $stmt_Projets->bindParam(":illustration", $this->illustration);

            if($stmt_Projets->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteProjets(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_projet = ?";
            $stmt_Projets = $this->conn->prepare($sqlQuery);
        
            $this->id_projet=htmlspecialchars(strip_tags($this->id_projet));
        
            $stmt_Projets->bindParam(1, $this->id_projet);
        
            if($stmt_Projets->execute()){
                return true;
            }
            return false;
        }
    }
?>