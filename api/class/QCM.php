<?php
    class QCM{

        // Connection
        private $conn;

        // Table
        private $db_table = "qcm";

        // Columns
        public $id_question;
        public $question;
 
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getQCM(){
            $sqlQuery = "SELECT id_question, question FROM " . $this->db_table . "";
            $stmt_QCM = $this->conn->prepare($sqlQuery);
            $stmt_QCM->execute();
            return $stmt_QCM;
        }

        // CREATE
        public function createQCM(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET  
                        question = :question";
        
            $stmt_QCM = $this->conn->prepare($sqlQuery);
        
            // Sanitize
            $this->question=htmlspecialchars(strip_tags($this->question));
        
            // Bind data
            $stmt_QCM->bindParam(":question", $this->question);
        
            if($stmt_QCM->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleQCM(){
            $sqlQuery = "SELECT
                        id_question, 
                        question
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_question = ?
                    LIMIT 0,1";
            $stmt_QCM = $this->conn->prepare($sqlQuery);
            $stmt_QCM->bindParam(1, $this->id_question);
            $stmt_QCM->execute();
            $dataRow = $stmt_QCM->fetch(PDO::FETCH_ASSOC);
            
            $this->id_question = $dataRow['id_question'];
            $this->question = $dataRow['question'];
        }   

        // UPDATE
        public function updateQCM(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET 
                        question = :question
                    WHERE 
                        id_question = :id_question";
        
            $stmt_QCM = $this->conn->prepare($sqlQuery);
        
            $this->question=htmlspecialchars(strip_tags($this->question));
        
            // Bind data
            $stmt_QCM->bindParam(":question", $this->question);

            if($stmt_QCM->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteQCM(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_question = ?";
            $stmt_QCM = $this->conn->prepare($sqlQuery);
        
            $this->id_question=htmlspecialchars(strip_tags($this->id_question));
        
            $stmt_QCM->bindParam(1, $this->id_question);
        
            if($stmt_QCM->execute()){
                return true;
            }
            return false;
        }
    }
?>