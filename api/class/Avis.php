<?php
    class Contact{

        // Connection
        private $conn;

        // Table
        private $db_table = "contact";

        // Columns
        public $id_avis;
        public $message;
        public $email;
        public $statut;
 
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getContact(){
            $sqlQuery = "SELECT id_avis, message, email, statut FROM " . $this->db_table . "";
            $stmt_contact = $this->conn->prepare($sqlQuery);
            $stmt_contact->execute();
            return $stmt_contact;
        }

        // CREATE
        public function createContact(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET 
                        message = :message, 
                        email = :email, 
                        statut = :statut";
        
            $stmt_contact = $this->conn->prepare($sqlQuery);
        
            // Sanitize
            //$this->id_avis=htmlspecialchars(strip_tags($this->id_avis));
            $this->contact=htmlspecialchars(strip_tags($this->message));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->statut=htmlspecialchars(strip_tags($this->statut));
        
            // Bind data
            //$stmt_contact->bindParam(":id_avis", $this->id_avis);
            $stmt_contact->bindParam(":message", $this->message);
            $stmt_contact->bindParam(":email", $this->email);
            $stmt_contact->bindParam(":statut", $this->statut);
        
            if($stmt_contact->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleContact(){
            $sqlQuery = "SELECT
                        id_avis, 
                        message, 
                        email, 
                        statut
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt_contact = $this->conn->prepare($sqlQuery);
            $stmt_contact->bindParam(1, $this->id_avis);
            $stmt_contact->execute();
            $dataRow = $stmt_contact->fetch(PDO::FETCH_ASSOC);
            
            $this->id_avis = $dataRow['id_avis'];
            $this->message = $dataRow['message'];
            $this->email = $dataRow['email'];
            $this->statut = $dataRow['statut'];
        }   

        // UPDATE
        public function updateContact(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        message = :message, 
                        email = :email, 
                        statut = :statut
                    WHERE 
                        id_avis = :id_avis";
        
            $stmt_contact = $this->conn->prepare($sqlQuery);
        
            $this->id_avis=htmlspecialchars(strip_tags($this->id_avis));
            $this->message=htmlspecialchars(strip_tags($this->message));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->statut=htmlspecialchars(strip_tags($this->statut));
        
            // Bind data
            $stmt_contact->bindParam(":id_avis", $this->id_avis);
            $stmt_contact->bindParam(":message", $this->message);
            $stmt_contact->bindParam(":email", $this->email);
            $stmt_contact->bindParam(":statut", $this->statut);

            if($stmt_contact->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteContact(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_avis = ?";
            $stmt_contact = $this->conn->prepare($sqlQuery);
        
            $this->id_avis=htmlspecialchars(strip_tags($this->id_avis));
        
            $stmt_contact->bindParam(1, $this->id_avis);
        
            if($stmt_contact->execute()){
                return true;
            }
            return false;
        }
    }
?>