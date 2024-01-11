<?php
    class Utilisateurs{

        // Connection
        private $conn;

        // Table
        private $db_table = "utilisateurs";

        // Columns
        public $id_utilisateur;
        public $admin;
        public $email;
        public $telephone;
        public $nom;
        public $prenom;
        public $nv_etudes;
        public $transport;
        public $distance;
        public $type_bac;
        public $presence_jpo;
        public $email2;
        public $mdp;
 
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUtilisateurs(){
            $sqlQuery = "SELECT id_utilisateur, admin, email, telephone, nom, prenom, nv_etudes, transport, distance, type_bac, presence_jpo, mdp FROM " . $this->db_table . "";
            $stmt_Utilisateurs = $this->conn->prepare($sqlQuery);
            $stmt_Utilisateurs->execute();
            return $stmt_Utilisateurs;
        }

        // GET UTILISATEURS BY EMAIL
        public function getUtilisateursByEmail($email2){
            $sqlQuery = "SELECT id_utilisateur, admin, email, telephone, nom, prenom, nv_etudes, transport, distance, type_bac, presence_jpo, mdp FROM " . $this->db_table . "WHERE email = ".$email2."";
            $stmt_Utilisateurs = $this->conn->prepare($sqlQuery);
            $stmt_Utilisateurs->execute();
            return $stmt_Utilisateurs;
        }

        // CREATE
        public function createUtilisateurs(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET  
                        email = :email,
                        telephone = :telephone,
                        nom = :nom,
                        prenom = :prenom,
                        nv_etudes = :nv_etudes,
                        transport = :transport,
                        distance = :distance,
                        type_bac = :type_bac";
        
            $stmt_Utilisateurs = $this->conn->prepare($sqlQuery);
        
            // Sanitize
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->telephone=htmlspecialchars(strip_tags($this->telephone));
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->nv_etudes=htmlspecialchars(strip_tags($this->nv_etudes));
            $this->transport=htmlspecialchars(strip_tags($this->transport));
            $this->distance=htmlspecialchars(strip_tags($this->distance));
            $this->type_bac=htmlspecialchars(strip_tags($this->type_bac));
        
            // Bind data
            $stmt_Utilisateurs->bindParam(":email", $this->email);
            $stmt_Utilisateurs->bindParam(":telephone", $this->telephone);
            $stmt_Utilisateurs->bindParam(":nom", $this->nom);
            $stmt_Utilisateurs->bindParam(":prenom", $this->prenom);
            $stmt_Utilisateurs->bindParam(":nv_etudes", $this->nv_etudes);
            $stmt_Utilisateurs->bindParam(":transport", $this->transport);
            $stmt_Utilisateurs->bindParam(":distance", $this->distance);
            $stmt_Utilisateurs->bindParam(":type_bac", $this->type_bac);
        
            if($stmt_Utilisateurs->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleUtilisateurs(){
            $sqlQuery = "SELECT
                        id_utilisateur, 
                        admin,
                        email,
                        telephone,
                        nom,
                        prenom,
                        nv_etudes,
                        transport,
                        distance,
                        type_bac,
                        presence_jpo,
                        email
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_utilisateur = ?
                    LIMIT 0,1";
            $stmt_Utilisateurs = $this->conn->prepare($sqlQuery);
            $stmt_Utilisateurs->bindParam(1, $this->id_utilisateur);
            $stmt_Utilisateurs->execute();
            $dataRow = $stmt_Utilisateurs->fetch(PDO::FETCH_ASSOC);
            
            $this->id_utilisateur = $dataRow['id_utilisateur'];
            $this->admin = $dataRow['admin'];
            $this->email = $dataRow['email'];
            $this->telephone = $dataRow['telephone'];
            $this->nom = $dataRow['nom'];
            $this->prenom = $dataRow['prenom'];
            $this->nv_etudes = $dataRow['nv_etudes'];
            $this->transport = $dataRow['transport'];
            $this->distance = $dataRow['distance'];
            $this->type_bac = $dataRow['type_bac'];
            $this->presence_jpo = $dataRow['presence_jpo'];
        }   

        // UPDATE
        public function updateUtilisateurs(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET 
                        email = :email,
                        telephone = :telephone,
                        nom = :nom,
                        prenom = :prenom,
                        nv_etudes = :nv_etudes,
                        transport = :transport,
                        distance = :distance,
                        type_bac = :type_bac
                    WHERE 
                        id_utilisateur = :id_utilisateur";
        
            $stmt_Utilisateurs = $this->conn->prepare($sqlQuery);
        
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->telephone=htmlspecialchars(strip_tags($this->telephone));
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->nv_etudes=htmlspecialchars(strip_tags($this->nv_etudes));
            $this->transport=htmlspecialchars(strip_tags($this->transport));
            $this->distance=htmlspecialchars(strip_tags($this->distance));
            $this->type_bac=htmlspecialchars(strip_tags($this->type_bac));
        
            // Bind data
            $stmt_Utilisateurs->bindParam(":email", $this->email);
            $stmt_Utilisateurs->bindParam(":telephone", $this->telephone);
            $stmt_Utilisateurs->bindParam(":nom", $this->nom);
            $stmt_Utilisateurs->bindParam(":prenom", $this->prenom);
            $stmt_Utilisateurs->bindParam(":nv_etudes", $this->nv_etudes);
            $stmt_Utilisateurs->bindParam(":transport", $this->transport);
            $stmt_Utilisateurs->bindParam(":distance", $this->distance);
            $stmt_Utilisateurs->bindParam(":type_bac", $this->type_bac);

            if($stmt_Utilisateurs->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUtilisateurs(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_utilisateur = ?";
            $stmt_Utilisateurs = $this->conn->prepare($sqlQuery);
        
            $this->id_utilisateur=htmlspecialchars(strip_tags($this->id_utilisateur));
        
            $stmt_Utilisateurs->bindParam(1, $this->id_utilisateur);
        
            if($stmt_Utilisateurs->execute()){
                return true;
            }
            return false;
        }
    }
?>