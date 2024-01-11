<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

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

    $item_Avis = new Contact($db);
    $item_DateJPO = new DateJPO($db);
    $item_Projets = new Projets($db);
    $item_QCM = new QCM($db);
    $item_Reponses = new Reponses($db);
    $item_Utilisateurs = new Utilisateurs($db);

    $emp_Avis = new Contact($db);
    $emp_DateJPO = new DateJPO($db);
    $emp_Projets = new Projets($db);
    $emp_QCM = new QCM($db);
    $emp_Reponses = new Reponses($db);
    $emp_Utilisateurs = new Utilisateurs($db);

    $stmt_Avis = $item_Avis->getContact();
    $stmt_DateJPO = $item_DateJPO->getDateJPO();
    $stmt_Projets = $item_Projets->getProjets();
    $stmt_QCM = $item_QCM->getQCM();
    $stmt_Reponses = $item_Reponses->getReponses();
    $stmt_Utilisateurs = $item_Utilisateurs->getUtilisateurs();

    $itemCount_Avis = $stmt_Avis->rowCount();
    $itemCount_DateJPO = $stmt_DateJPO->rowCount();
    $itemCount_Projets = $stmt_Projets->rowCount();
    $itemCount_QCM = $stmt_QCM->rowCount();
    $itemCount_Reponses = $stmt_Reponses->rowCount();
    $itemCount_Utilisateurs = $stmt_Utilisateurs->rowCount();

    json_encode($itemCount_Avis);
    json_encode($itemCount_DateJPO);
    json_encode($itemCount_Projets);
    json_encode($itemCount_QCM);
    json_encode($itemCount_Reponses);
    json_encode($itemCount_Utilisateurs);

    if(isset($_GET['info']) && $_GET['info'] == "avis"){
        if($itemCount_QCM > 0){
            $QCMArr = array();
            $QCMArr["body"] = array();
            $QCMArr["itemCount_QCM"] = $itemCount_QCM;
            while ($row_QCM = $stmt_QCM->fetch(PDO::FETCH_ASSOC)){
                extract($row_QCM);
                $e = array(
                    "id_question" => $id_question, 
                    "question" => $question 
                );
                array_push($QCMArr["body"], $e);
            }
            echo json_encode($QCMArr);
        }
    } else {
    if(isset($_GET['info']) && $_GET['info'] == "accueil"){
        if($itemCount_DateJPO > 0){
            $DateJPOArr = array();
            $DateJPOArr["body"] = array();
            $DateJPOArr["itemCount_DateJPO"] = $itemCount_DateJPO;
            while ($row_DateJPO = $stmt_DateJPO->fetch(PDO::FETCH_ASSOC)){
                extract($row_DateJPO);
                $e = array(
                    "id_creneau" => $id_creneau, 
                    "date" => $date 
                );
                array_push($DateJPOArr["body"], $e);
            }
            echo json_encode($DateJPOArr);
        }    
    } else{
    if(isset($_GET['info']) && $_GET['info'] == "admin"){
        if($itemCount_Utilisateurs > 0){
            $UtilisateursArr = array();
            $UtilisateursArr["body"] = array();
            $UtilisateursArr["itemCount_Utilisateurs"] = $itemCount_Utilisateurs;
            while ($row_Utilisateurs = $stmt_Utilisateurs->fetch(PDO::FETCH_ASSOC)){
                extract($row_Utilisateurs);
                $e = array(
                    "id_utilisateur" => $id_utilisateur, 
                    "admin" => $admin,
                    "email" => $email,
                    "telephone" => $telephone,
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "nv_etudes" => $nv_etudes,
                    "transport" => $transport,
                    "distance" => $distance,
                    "type_bac" => $type_bac,
                    "presence_jpo" => $presence_jpo,
                    "mdp" => $mdp
                );
                array_push($UtilisateursArr["body"], $e);
            }
            echo json_encode($UtilisateursArr);
        }
    } else {
    if(isset($_GET['info']) && $_GET['info'] == "reponses"){
        if($itemCount_Reponses > 0){
            $ReponsesArr = array();
            $ReponsesArr["body"] = array();
            $ReponsesArr["itemCount_Reponses"] = $itemCount_Reponses;
            while ($row_Reponses = $stmt_Reponses->fetch(PDO::FETCH_ASSOC)){
                extract($row_Reponses);
                $e = array(
                    "id_reponse" => $id_reponse, 
                    "email" => $email,
                    "id_question" => $id_question,
                    "reponse" => $reponse
                );
                array_push($ReponsesArr["body"], $e);
            }
            echo json_encode($ReponsesArr);
        }
    }
    else {

    if($itemCount_Avis > 0){
        $AvisArr = array();
        $AvisArr["body"] = array();
        $AvisArr["itemCount_Avis"] = $itemCount_Avis;
        while ($row_Avis = $stmt_Avis->fetch(PDO::FETCH_ASSOC)){
            extract($row_Avis);
            $e = array(
                "id_avis" => $id_avis, 
                "message" => $message, 
                "email" => $email,
                "statut" => $statut
            );
            array_push($AvisArr["body"], $e);
        }
        echo json_encode($AvisArr);
    }

    if($itemCount_Projets > 0){
        $ProjetsArr = array();
        $ProjetsArr["body"] = array();
        $ProjetsArr["itemCount_Projets"] = $itemCount_Projets;
        while ($row_Projets = $stmt_Projets->fetch(PDO::FETCH_ASSOC)){
            extract($row_Projets);
            $e = array(
                "id_projet" => $id_projet, 
                "filiere" => $filiere, 
                "description" => $description, 
                "titre" => $titre, 
                "lien" => $lien, 
                "illustration" => $illustration
            );
            array_push($ProjetsArr["body"], $e);
        }
        echo json_encode($ProjetsArr);
    }
}}
}
}
?>