/*<?php
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

    $data = json_decode(file_get_contents("php://input"));

    @$id_avis=$data->id_avis;
    @$id_creneau=$data->id_creneau;
    @$id_reponse=$data->id_reponse;
    @$id_projet=$data->id_projet;
    @$id_question=$data->id_question;
    @$id_utilisateur=$data->id_utilisateur;

    @$avis=$data->avis;
    @$nom_etudiants=$data->nom_etudiants;
    @$filiere_avis=$data->filiere_avis;
    @$date=$data->date;
    @$filiere=$data->filiere;
    @$description=$data->description;
    @$titre=$data->titre;
    @$lien=$data->lien;
    @$question=$data->question;
    @$reponse=$data->reponse;
    @$email=$data->email;
    @$telephone=$data->telephone;
    @$nom=$data->nom;
    @$prenom=$data->prenom;
    @$nv_etudes=$data->nv_etudes;
    @$transport=$data->transport;
    @$distance=$data->distance;
    @$type_bac=$data->type_bac;
    
    // Si je récupère les données de "avis" alors j'update la ligne
    if($id_avis && $avis && $nom_etudiants && $filiere_avis) {
        $item_Avis = new Avis($db);

        // Table Avis
        $item_Avis->id_avis = $data->id_avis;
        $item_Avis->avis = $data->avis;
        $item_Avis->nom_etudiants = $data->nom_etudiants;
        $item_Avis->filiere = $data->filiere_avis;

        $item_Avis->updateAvis();
        echo json_encode("Avis updated.");
    } else { echo json_encode("Avis could not be updated"); }
    
    if($id_creneau && $date) {
        $item_DateJPO = new DateJPO($db);

        // Table DateJPO
        $item_DateJPO->id_creneau = $data->id_creneau;
        $item_DateJPO->date = $data->date;

        $item_DateJPO->updateDateJPO();
        echo json_encode("Date JPO updated.");
    } else { echo json_encode("DateJPO could not be updated"); }
    
    if($id_projet && $filiere && $description && $titre && $lien) {
        $item_Projets = new Projets($db);
        
        // Table Projets
        $item_Projets->id_projet = $data->id_projet;
        $item_Projets->filiere = $data->filiere;
        $item_Projets->description = $data->description;
        $item_Projets->titre = $data->titre;
        $item_Projets->lien = $data->lien;
        $item_Projets->illustration = 0;

        $item_Projets->updateProjets();
        echo json_encode("Projets updated.");
    } else { echo json_encode("Projets could not be updated"); }

    if ($id_question && $question) {
        $item_QCM = new QCM($db);

        // Table QCM 
        $item_QCM->id_question = $data->id_question;
        $item_QCM->question = $data->question;

        $item_QCM->updateQCM();
        echo json_encode("QCM updated.");
    } else { echo json_encode("QCM could not be updated"); }

    if ($id_reponse && $data->reponse) {
        $item_Reponses = new Reponses($db);

        // Table Reponses
        $item_Reponses->id_reponse = $data->id_reponse;
        //$item_Reponses->id_utilisateur = $data->id_utilisateur;
        //$item_Reponses->id_question = $data->id_question;
        $item_Reponses->reponse = $data->reponse;

        $item_Reponses->updateReponses();
        echo json_encode("Reponses updated.");
    } else { echo json_encode("Réponses could not be updated"); }

    if ($id_utilisateur && $email && $telephone && $nom && $prenom && $nv_etudes && $transport && $distance && $type_bac) {
        $item_Utilisateurs = new Utilisateurs($db);

         // Table Utilisateurs 
        $item_Utilisateurs->id_utilisateur = $data->id_utilisateur;
        $item_Utilisateurs->admin = 0;
        $item_Utilisateurs->email = $data->email;
        $item_Utilisateurs->telephone = $data->telephone;
        $item_Utilisateurs->nom = $data->nom;
        $item_Utilisateurs->prenom = $data->prenom;
        $item_Utilisateurs->nv_etudes = $data->nv_etudes;
        $item_Utilisateurs->transport = $data->transport;
        $item_Utilisateurs->distance = $data->distance;
        $item_Utilisateurs->type_bac = $data->type_bac;
        $item_Utilisateurs->presence_jpo = 0;

        $item_Utilisateurs->updateUtilisateurs();
        echo json_encode("Utilisateurs updated.");
    } else { echo json_encode("Utilisateurs could not be updated"); }
?>