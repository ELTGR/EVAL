
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="style.css" >
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/classroom.css">
    <link rel="stylesheet" href="css/profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Page PHP HTML</title>
</head>
<?php

#connection à la base de donnée
$user_db= new mysqli("localhost", "root", "", "data_base");
if($user_db->connect_errno){
    die("connexion a échoué : " . $user_db->connect_error);
}
#on recupere la database des users avant car on en aura besion dans les deux cas 
$sql_select_pseudp_email = "SELECT pseudo,email,password FROM user;";
$all_data = $user_db->query($sql_select_pseudp_email);

#on mets les varaibles dans des list car je viens du python
$list_pseudo = array("");
$list_email = array("");
$list_password = array("");
while ($row = mysqli_fetch_assoc($all_data)) {
    array_push($list_pseudo, $row['pseudo']);
    array_push($list_email, $row['email']);
    array_push($list_password, $row['password']);
}
$nom_email = "email";       
$nom_pseudo = "pseudo";
$nom_password = "password";
$duree = time()+3600;

#on check si le bouton inscription ou connexion est utilisé
$_connect = False ;
$connexion = isset($_POST['connexion']) ? $_POST['connexion']: FALSE ;
$inscription = isset($_POST['inscription']) ? $_POST['inscription']: FALSE ;

# A REVOIR !!!! si connexion alors on check dans la base de donnée si le mdp est bon  A REVOIR !!!! 
#sinon on inscrit dans la base de données le nouvel utilisateur 
if ($connexion){
    $pseudo_connexion = isset($_POST['pseudo_connexion']) ? $_POST['pseudo_connexion']: FALSE ;
    $password_connexion = isset($_POST['password_connexion']) ? hash("sha512",($_POST['password_connexion'])): FALSE ;
    
    echo $pseudo_connexion;
    echo $password_connexion;
    if($pseudo_connexion && $password_connexion) {
        $_connect = FALSE;
        for ($i = 0; $i < count($list_pseudo); $i++) {
            if ($list_pseudo[$i] == $pseudo_connexion && $list_password[$i] == $password_connexion) {
                $_connect = TRUE;
            }
        }
    }
    if ($_connect = TRUE){
        setcookie($nom_pseudo, $pseudo_connexion, $duree,"/");
        setcookie($nom_password, $password_connexion, $duree,"/");
    }
}
elseif($inscription){
    $email_inscription = isset($_POST['email_inscription']) ? $_POST['email_inscription']: FALSE ;
    $pseudo_inscription = isset($_POST['pseudo_inscription']) ? $_POST['pseudo_inscription']: FALSE ;
    $password_inscription = isset($_POST['password_inscription']) ? hash("sha512",($_POST['password_inscription'])): FALSE ;
    echo $email_inscription;
    echo $pseudo_inscription;
    echo $password_inscription;
    $not_already_in = TRUE;

    for ($i = 0; $i < count($list_pseudo); $i++) {
        if ($list_pseudo[$i] == $pseudo_inscription) {
            $not_already_in = FALSE; 
        }
        // Comparer l'email avec la variable
        if ($list_email[$i] == $email_inscription) {
            $not_already_in = FALSE;
        }

    }
    
    if($not_already_in){

        $id = count($list_pseudo);
        $sql_inscription = "INSERT INTO user (id, pseudo, email, password) VALUES (\"$id\", \"$pseudo_inscription\", \"$email_inscription\", \"$password_inscription\");";


        $user_db->query($sql_inscription);
    
        # A REVOIR !!!! creation des coockie A REVOIR !!!!
    
        $nom_email = "email";       
        $nom_pseudo = "pseudo";
        $nom_password = "password";
        $duree = time()+3600;
        setcookie($nom_pseudo, $pseudo_inscription, $duree,"/");
        setcookie($nom_password, $password_inscription, $duree,"/");
        $_connect = True ;
        echo "cookie created";
            }

    else{
        echo "TU ES DEJA INSCRIT TROU DUC ";
    }}
?>
<body>

<?php
#Ajouter le header 
    include("header_footer/my_header.php");


#si pas de connection alors load la page demander 
$page = isset($_GET['page']) ? $_GET['page']: 0 ;
$pagePath = "pages/".$page.".php";


#check la paff 
$cookie_ok = FALSE;
if(isset($_COOKIE[$nom_pseudo])&& isset($_COOKIE[$nom_password])){
    for ($i = 0; $i < count($list_pseudo); $i++) {
        if ($list_pseudo[$i] == $_COOKIE[$nom_pseudo]) {
            $cookie_ok = TRUE; 
        }
        // Comparer l'email avec la variable
        if ($list_password[$i] == $_COOKIE[$nom_password]) {
            $cookie_ok = TRUE;
        }}

}

if($_connect){
    $pagePath = "pages/classroom.php";
    include($pagePath);
}
elseif(file_exists($pagePath) && $cookie_ok ){
    include($pagePath);
} 
elseif ($cookie_ok) {
    $pagePath = "pages/classroom.php";
    include($pagePath);
}
else{
    include("pages/login.php");
}
?>

</body>

<?php include("header_footer/my_footer.php");?>



</html>
