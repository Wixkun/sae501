<?php
    class Reponses{

        // Connection
        private $conn;

        // Table
        private $db_table = "reponses_qcm";

        // Columns
        public $id_reponse;
        public $email;
        public $id_question;
        public $reponse;
 
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getReponses(){
            $sqlQuery = "SELECT id_reponse, email, id_question, reponse FROM " . $this->db_table . "";
            $stmt_Reponses = $this->conn->prepare($sqlQuery);
            $stmt_Reponses->execute();
            return $stmt_Reponses;
        }

        // CREATE
        public function createReponses(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET  
                        email = :email,
                        id_question = :id_question,
                        reponse = :reponse";
        
            $stmt_Reponses = $this->conn->prepare($sqlQuery);
        
            // Sanitize
            $this->email=htmlspecialchars(strip_tags($this->email));
        
            // Bind data
            $stmt_Reponses->bindParam(":reponse", $this->reponse);
            $stmt_Reponses->bindParam(":id_question", $this->id_question);
            $stmt_Reponses->bindParam(":email", $this->email);
        
            if($stmt_Reponses->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleReponses(){
            $sqlQuery = "SELECT
                        id_reponse, 
                        email,
                        id_question,
                        reponse
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_reponse = ?
                    LIMIT 0,1";
            $stmt_Reponses = $this->conn->prepare($sqlQuery);
            $stmt_Reponses->bindParam(1, $this->id_reponse);
            $stmt_Reponses->execute();
            $dataRow = $stmt_Reponses->fetch(PDO::FETCH_ASSOC);
            
            $this->id_reponse = $dataRow['id_reponse'];
            $this->email = $dataRow['email'];
            $this->id_question = $dataRow['id_question'];
            $this->reponse = $dataRow['reponse'];
        }   

        // UPDATE
        public function updateReponses(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET 
                        reponse = :reponse
                    WHERE 
                        id_reponse = :id_reponse";
        
            $stmt_Reponses = $this->conn->prepare($sqlQuery);
        
            $this->reponse=htmlspecialchars(strip_tags($this->reponse));
        
            // Bind data
            $stmt_Reponses->bindParam(":reponse", $this->reponse);

            if($stmt_Reponses->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteReponses(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_reponse = ?";
            $stmt_Reponses = $this->conn->prepare($sqlQuery);
        
            $this->id_reponse=htmlspecialchars(strip_tags($this->id_reponse));
        
            $stmt_Reponses->bindParam(1, $this->id_reponse);
        
            if($stmt_Reponses->execute()){
                return true;
            }
            return false;
        }
    }
?>