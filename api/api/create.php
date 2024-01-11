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
    
    $data = json_decode(file_get_contents("php://input"));

    @$message=$data->message;
    @$nom_etudiants=$data->nom_etudiants;
    @$statut=$data->statut;
    @$date=$data->date;
    @$filiere=$data->filiere;
    @$description=$data->description;
    @$titre=$data->titre;
    @$lien=$data->lien;
    @$question=$data->question;
    @$id_question=$data->id_question;
    @$reponse=$data->reponse;
    @$email=$data->email;
    @$telephone=$data->telephone;
    @$nom=$data->nom;
    @$prenom=$data->prenom;
    @$nv_etudes=$data->nv_etudes;
    @$transport=$data->transport;
    @$distance=$data->distance;
    @$type_bac=$data->type_bac;

    // Si je récupère les données de "avis" alors je le crée 
    if($message && $email && $statut) {
        $item_Avis = new Contact($db);

        // Table Avis
        $item_Avis->message = $data->message;
        $item_Avis->email = $data->email;
        $item_Avis->statut = $data->statut;

        $item_Avis->createContact();
        echo json_encode("Contact created.");
        exit;
    } else { echo json_encode("Contact could not be created"); }

    if($date) {
        $item_DateJPO = new DateJPO($db);

        // Table DateJPO
        $item_DateJPO->date = $data->date;

        $item_DateJPO->createDateJPO();
        echo json_encode("Date JPO created.");
        exit;
    } else { echo json_encode("DateJPO could not be created"); }

    if($filiere && $description && $titre && $lien) {
        $item_Projets = new Projets($db);
        
        // Table Projets
        $item_Projets->filiere = $data->filiere;
        $item_Projets->description = $data->description;
        $item_Projets->titre = $data->titre;
        $item_Projets->lien = $data->lien;
        $item_Projets->illustration = 0;

        $item_Projets->createProjets();
        echo json_encode("Projets created.");
        exit;
    } else { echo json_encode("Projets could not be created"); }

    if ($question) {
        $item_QCM = new QCM($db);

        // Table QCM 
        $item_QCM->question = $data->question;

        $item_QCM->createQCM();
        echo json_encode("QCM created.");
        exit;
    } else { echo json_encode("QCM could not be created"); }

    if($email && $id_question && $reponse) {
        $item_Reponses = new Reponses($db);

        // Table Reponses
        $item_Reponses->email = $data->email;
        $item_Reponses->id_question = $data->id_question;
        $item_Reponses->reponse = $data->reponse;

        $item_Reponses->createReponses();
        echo json_encode("Reponses created.");
        exit;
    } else { echo json_encode("Reponses could not be created"); }



    if ($email && $telephone && $nom && $prenom && $nv_etudes && $transport && $distance && $type_bac) {
        $item_Utilisateurs = new Utilisateurs($db);

         // Table Utilisateurs 
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
        $item_Utilisateurs->mdp = 0;

        $item_Utilisateurs->createUtilisateurs();
        echo json_encode("Utilisateurs created.");
    } else { echo json_encode("Utilisateurs could not be created"); }
   
?>