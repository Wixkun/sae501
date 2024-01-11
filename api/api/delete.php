<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Connection BDD
    include_once '../config/database.php';

    // Class
    include_once '../class/Avis.php';
    include_once '../class/DateJPO.php';
    include_once '../class/Projets.php';
    include_once '../class/QCM.php';
    include_once '../class/Reponses.php';
    include_once '../class/Utilisateurs.php';
    
    $database = new Database();
    $db = $database->getConnection();

    // A FAIRE - GESTION WARNING

    // Pour test sur POSTMAN
    $data = json_decode(file_get_contents("php://input"));

    @$id_avis=$data->id_avis;
    @$id_creneau=$data->id_creneau;
    @$id_reponse=$data->id_reponse;
    @$id_projet=$data->id_projet;
    @$id_question=$data->id_question;
    @$id_utilisateur=$data->id_utilisateur;

    // Si je récupère les données de "avis" alors je supprime la ligne
    if($id_avis) {
        $item_Avis = new Avis($db);

        // Table Avis
        $item_Avis->id_avis = $data->id_avis;
        //$item_Avis->avis = $data->avis;
        //$item_Avis->nom_etudiants = $data->nom_etudiants;
        //$item_Avis->filiere = $data->filiere_avis;

        $item_Avis->deleteAvis();
        echo json_encode("Avis deleted.");
    } else { echo json_encode("Avis could not be deleted"); }
    
    if($id_creneau) {
        $item_DateJPO = new DateJPO($db);

        // Table DateJPO
        $item_DateJPO->id_creneau = $data->id_creneau;
        //$item_DateJPO->date = $data->date;

        $item_DateJPO->deleteDateJPO();
        echo json_encode("Date JPO deleted.");
    } else { echo json_encode("DateJPO could not be deleted"); }
    
    if($id_projet) {
        $item_Projets = new Projets($db);
        
        // Table Projets
        $item_Projets->id_projet = $data->id_projet;
        //$item_Projets->filiere = $data->filiere;
        //$item_Projets->description = $data->description;
        //$item_Projets->titre = $data->titre;
        //$item_Projets->lien = $data->lien;
        //$item_Projets->illustration = 0;*/

        $item_Projets->deleteProjets();
        echo json_encode("Projets deleted.");
    } else { echo json_encode("Projets could not be deleted"); }

    if ($id_question) {
        $item_QCM = new QCM($db);

        // Table QCM 
        $item_QCM->id_question = $data->id_question;
        //$item_QCM->question = $data->question;

        $item_QCM->deleteQCM();
        echo json_encode("QCM deleted.");
    } else { echo json_encode("QCM could not be deleted"); }

    if ($id_reponse) {
        $item_Reponses = new Reponses($db);

        // Table Reponses
        $item_Reponses->id_reponse = $data->id_reponse;
        //$item_Reponses->id_utilisateur = $data->id_utilisateur;
        //$item_Reponses->id_question = $data->id_question;
        //$item_Reponses->reponse = $data->reponse;

        $item_Reponses->deleteReponses();
        echo json_encode("Reponses deleted.");
    } else { echo json_encode("Réponses could not be deleted"); }

    if ($id_utilisateur) {
        $item_Utilisateurs = new Utilisateurs($db);

        // Table Utilisateurs 
        $item_Utilisateurs->id_utilisateur = $data->id_utilisateur;
        //$item_Utilisateurs->admin = 0;
        //$item_Utilisateurs->email = $data->email;
        //$item_Utilisateurs->telephone = $data->telephone;
        //$item_Utilisateurs->nom = $data->nom;
        //$item_Utilisateurs->prenom = $data->prenom;
        //$item_Utilisateurs->nv_etudes = $data->nv_etudes;
        //$item_Utilisateurs->transport = $data->transport;
        //$item_Utilisateurs->distance = $data->distance;
        //$item_Utilisateurs->type_bac = $data->type_bac;
        //$item_Utilisateurs->presence_jpo = 0;

        $item_Utilisateurs->deleteUtilisateurs();
        echo json_encode("Utilisateurs deleted.");
    } else { echo json_encode("Utilisateurs could not be deleted"); }
    
   /* $item_Avis = new Avis($db);
    $item_DateJPO = new DateJPO($db);
    $item_Projets = new Projets($db);
    $item_QCM = new QCM($db);
    $item_Reponses = new Reponses($db);
    $item_Utilisateurs = new Utilisateurs($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    // Table Avis
    $item_Avis->id_avis = $data->id_avis;
    $item_Avis->avis = $data->avis;
    $item_Avis->nom_etudiants = $data->nom_etudiants;
    $item_Avis->filiere = $data->filiere;

    // Table DateJPO
    $item_DateJPO->id_creneau = $data->id_creneau;
    $item_DateJPO->date = $data->date;
    
    // Table Projets
    $item_Projets->id_projet = $data->id_projet;
    $item_Projets->filiere = $data->filiere;
    $item_Projets->description = $data->description;
    $item_Projets->titre = $data->titre;
    $item_Projets->lien = $data->lien;
    $item_Projets->illustration = $data->illustration;

    // Table QCM 
    $item_QCM->id_question = $data->id_question;
    $item_QCM->question = $data->question;

    // Table Reponses
    $item_Reponses->id_reponse = $data->id_reponse;
    $item_Reponses->id_utilisateur = $data->id_utilisateur;
    $item_Reponses->id_question = $data->id_question;
    $item_Reponses->reponse = $data->reponse;

    // Table Utilisateurs 
    $item_Utilisateurs->id_utilisateur = $data->id_utilsiateur;
    $item_Utilisateurs->admin = $data->admin;
    $item_Utilisateurs->email = $data->email;
    $item_Utilisateurs->telephone = $data->telephone;
    $item_Utilisateurs->nom = $data->nom;
    $item_Utilisateurs->prenom = $data->prenom;
    $item_Utilisateurs->nv_etudes = $data->nv_etudes;
    $item_Utilisateurs->transport = $data->transport;
    $item_Utilisateurs->distance = $data->distance;
    $item_Utilisateurs->type_bac = $data->type_bac;
    $item_Utilisateurs->presence_jpo = $data->presence_jpo;
    
    if($item_Avis->deleteAvis()){
        echo json_encode("Avis deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }

    if($item_DateJPO->deleteDateJPO()){
        echo json_encode("Date JPO deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }

    if($item_Projets->deleteProjets()){
        echo json_encode("Projets deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }

    if($item_QCM->deleteQCM()){
        echo json_encode("QCM deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }

    if($item_Reponses->deleteReponses()){
        echo json_encode("Reponses deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }

    if($item_Utilisateurs->deleteUtilisateurs()){
        echo json_encode("Utilisateurs deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }*/
?>