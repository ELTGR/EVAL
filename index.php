
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/game.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="BOXE!" content="width=device-width, initial-scale=1.0">
    <title>BOXE!</title>
</head>
<?php

    #connection à la base de donnée
    $user_db= new mysqli("localhost", "root", "", "data_base");
    if($user_db->connect_errno){
        die("connexion a échoué : " . $user_db->connect_error);
    }

    #on recupere la database des users avant car on en aura besion dans les deux cas 
    $sql_utilisateurs_data = "SELECT * FROM utilisateurs;";
    $all_data = $user_db->query($sql_utilisateurs_data);

    #on mets les varaibles dans des list
    $list_pseudo = array("");
    $list_email = array("");
    $list_password = array("");
    while ($row = mysqli_fetch_assoc($all_data)) {
        array_push($list_pseudo, $row['pseudo']);
        array_push($list_email, $row['email']);
        array_push($list_password, $row['mdp']);
    }

    #Je crée les noms qui seront utilisé pour les cookies
    $cookie_email = "email";       
    $cookie_pseudo = "pseudo";
    $cookie_password = "password";
    $duree = time()+3600;

    #varible qui va permettre de savoir si l'utilisateur se connect/s'incrit ou non
    $_connect = False ;

    #on recupere la valeur des bouton connexion et inscription pour savoir ce que l'utilisateur veut faire
    $connexion = isset($_POST['connexion']) ? $_POST['connexion']: FALSE ;
    $inscription = isset($_POST['inscription']) ? $_POST['inscription']: FALSE ;

    #si bouton connection == 1 
    if ($connexion){
        #on verifie si la personne à bien rentré les infos dont on a besion pour ce connecter
        $pseudo_connexion = isset($_POST['pseudo_connexion']) ? $_POST['pseudo_connexion']: FALSE ;
        $password_connexion = isset($_POST['password_connexion']) ? hash("sha512",($_POST['password_connexion'])): FALSE ;

        #Boucle qui verifie si le pseudo et le mdp correspond a une personne incrite dans la base de donnée
        if($pseudo_connexion && $password_connexion) {
            for ($i = 0; $i < count($list_pseudo); $i++) {
                if ($list_pseudo[$i] == $pseudo_connexion && $list_password[$i] == $password_connexion) {
                    #si mdp et pseudo correspond alors connect == TRUE et on crée nos cookies 
                    $_connect = TRUE;
                    setcookie($cookie_pseudo, $pseudo_connexion, $duree,"/");
                    setcookie($cookie_password, $password_connexion, $duree,"/");
                }
            }
        }

    }
    #si bouton inscription == 1 
    elseif($inscription){
        #on verifie si la personne à bien rentré les infos dont on a besion

        
        $password_inscription = isset($_POST['password_inscription']) ? hash("sha512",($_POST['password_inscription'])): FALSE ;
        $nom_inscription = isset($_POST['nom_inscription']) ? $_POST['nom_inscription']: FALSE;
        $prenom_inscription = isset($_POST['prenom_inscription']) ? $_POST['prenom_inscription']: FALSE;
        $genre_inscription = isset($_POST['genre_inscription']) ? $_POST['genre_inscription']: FALSE;
        $email_inscription = isset($_POST['email_inscription']) ? $_POST['email_inscription']: FALSE ;
        if($genre_inscription == "Homme" ){$genre_inscription = 1 ;}elseif($genre_inscription == "Femme" ){$genre_inscription = 2; }else{$genre_inscription = FALSE ;}
        if($password_inscription && $nom_inscription &&  $prenom_inscription && $genre_inscription && $email_inscription ){

            #creation du pseudo
            $pseudo_inscription = $prenom_inscription[0] . $nom_inscription;

            #on verifie si le pseudo n'est pas déja dans la base de données
            $already_in = FALSE;
            for ($i = 0; $i < count($list_pseudo); $i++) {
                if ($list_pseudo[$i] == $pseudo_inscription) {
                    $already_in = TRUE; }
                // Comparer l'email avec la variable
                if ($list_email[$i] == $email_inscription) {
                    $already_in = TRUE; }
                }
            # Si la personne est bien absente de la base de donnée alors on precede à son insertion
            if(!$already_in){

                
                #request SQL pour insert notre nouvel utilisateur à la base de données
                $sql_inscription = "INSERT INTO utilisateurs (pseudo, mdp, nom, prenom, genre, email) VALUES (\"$pseudo_inscription\", \"$password_inscription\",\"$nom_inscription\",\"$prenom_inscription\",\"$genre_inscription\", \"$email_inscription\");";
                #echo "sql_inscription".$sql_inscription;
                $user_db->query($sql_inscription);

                #Création des cookies
                $duree = time()+3600;
                setcookie($cookie_pseudo, $pseudo_inscription, $duree,"/");
                setcookie($cookie_password, $password_inscription, $duree,"/");
                $_connect = True ;
                }

            else{
                echo "pseudo déja utilisé ";
                }
        }
        else {
            echo "erreur : veuillez entre toutes les informations demandées";
        }
    }

    #ON check si la personne est à deja des cookiee 
    $cookie_ok = FALSE;
    if(isset($_COOKIE[$cookie_pseudo])&& isset($_COOKIE[$cookie_password])){
        for ($i = 0; $i < count($list_pseudo); $i++) {
            if ($list_pseudo[$i] == $_COOKIE[$cookie_pseudo]) {
                $cookie_ok = TRUE; 
            }
            // Comparer l'email avec la variable
            if ($list_password[$i] == $_COOKIE[$cookie_password]) {
                $cookie_ok = TRUE;
            }}
    }

?>
<body>
<!-- ===================== FIN DE LA PARTIE INSCRIPTION CONNEX ET COOKIES===============-->
<!--==============header==============-->
<?php include("pages/header.php");?>
<!--==============header==============-->
<!-- ===================== DEBUT PARTIE LOAD PAGE ECT===============-->
<?php


    #==============load page via ulr==============
    #Si la personne essais de se connecer a une pages via l'url
    $page = isset($_GET['page']) ? $_GET['page']: 0 ;
    #on ajoute un prefix et surfixe
    $pagePath = "pages/".$page.".php";
    #==============load page via ulr==============

    #==============load page en fonction de la page/cookie/ect==============
    #si on vient d'effectuer l'inscir/connex de la personne alors on laod la page principal
    if($_connect){
        $pagePath = "pages/game.php";
        include($pagePath);
    }
    # si la personne rentre une page qui hesite et que c'est cookies sont ok alors on laod
    elseif(file_exists($pagePath) && $cookie_ok){
        include($pagePath);
    } 
    # si la page n'est pas bonne mais les cookies oui alors page principal
    elseif ($cookie_ok) {
        $pagePath = "pages/game.php";
        include($pagePath);
    }
    # si la page n'est pas bonne et cookies aussi, alors login page
    else{
        include("pages/login.php");
    }
?>
</body>
<!--==============my_footer==============-->
<?php include("pages/footer.php");?>
<!--==============my_footer==============-->
</html>
