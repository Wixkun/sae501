<?php
    class DateJPO{

        // Connection
        private $conn;

        // Table
        private $db_table = "date_jpo";

        // Columns
        public $id_creneau;
        public $date;
 
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getDateJPO(){
            $sqlQuery = "SELECT id_creneau, date FROM " . $this->db_table . "";
            $stmt_DateJPO = $this->conn->prepare($sqlQuery);
            $stmt_DateJPO->execute();
            return $stmt_DateJPO;
        }

        // CREATE
        public function createDateJPO(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET 
                        id_creneau = :id_creneau, 
                        date = :date";
        
            $stmt_DateJPO = $this->conn->prepare($sqlQuery);
        
            // Sanitize
            $this->id_creneau=htmlspecialchars(strip_tags($this->id_creneau));
            $this->date=htmlspecialchars(strip_tags($this->date));
        
            // Bind data
            $stmt_DateJPO->bindParam(":id_creneau", $this->id_creneau);
            $stmt_DateJPO->bindParam(":date", $this->date);
        
            if($stmt_DateJPO->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleDateJPO(){
            $sqlQuery = "SELECT
                        id_creneau, 
                        date 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_creneau = ?
                    LIMIT 0,1";
            $stmt_DateJPO = $this->conn->prepare($sqlQuery);
            $stmt_DateJPO->bindParam(1, $this->id_creneau);
            $stmt_DateJPO->execute();
            $dataRow = $stmt_DateJPO->fetch(PDO::FETCH_ASSOC);
            
            $this->id_creneau = $dataRow['id_creneau'];
            $this->date = $dataRow['date'];
        }   

        // UPDATE
        public function updateDateJPO(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id_creneau = :id_creneau, 
                        date = :date
                    WHERE 
                        id_creneau = :id_creneau";
        
            $stmt_DateJPO = $this->conn->prepare($sqlQuery);
        
            $this->id_creneau=htmlspecialchars(strip_tags($this->id_creneau));
            $this->date=htmlspecialchars(strip_tags($this->date));
        
            // Bind data
            $stmt_DateJPO->bindParam(":id_creneau", $this->id_creneau);
            $stmt_DateJPO->bindParam(":date", $this->date);

            if($stmt_DateJPO->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteDateJPO(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_creneau = ?";
            $stmt_DateJPO = $this->conn->prepare($sqlQuery);
        
            $this->id_creneau=htmlspecialchars(strip_tags($this->id_creneau));
        
            $stmt_DateJPO->bindParam(1, $this->id_creneau);
        
            if($stmt_DateJPO->execute()){
                return true;
            }
            return false;
        }
    }
?>