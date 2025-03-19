
<?php 
#fonction qui permet de tirer un personnage adverse aléatoirement au debut d'un combat
function tirage_aleatoire_du_personne_adverse(){
    $sql_get_personnage = "SELECT * FROM `personnages`"
    $personnage_data = $user_db->query($sql_get_personnage);

    $list_pseudo  = array("")
    $list_puissance  = array("")
    $list_points_de_vie  = array("")
    $list_vitesse  = array("")
    $list_nom  = array("")
    $list_prenom  = array("")
    while ($row = mysqli_fetch_assoc($personnage_data)) {
        array_push($list_pseudo, $row['pseudo']);
        array_push($list_puissance, $row['puissance']);
        array_push($list_points_de_vie, $row['points_de_vie']);
        array_push($list_vitesse, $row['vitesse']);
        array_push($list_nom, $row['nom']);
        array_push($list_prenom, $row['prenom']);
    }

    $max_id = count($list_pseudo);
    $id_perso = rand(0, $max_id)

    $pgn_pseudo= $list_pseudo[$id_perso] 
    $pgn_pv =  $list_points_de_vie[$id_perso]
    $pgn_puisssance = $list_puissance[$id_perso]
    $pgn_vitesse = $list_vitesse[$id_perso] 
    $pgn_nom = $list_nom[$id_perso] 
    $pgn_prenom = $list_prenom[$id_perso] 

    return  $pgn_pv,$pgn_puisssance,$pgn_vitesse,$pgn_nom,$pgn_prenom
}

$pgn_pv,$pgn_puisssance,$pgn_vitesse,$pgn_nom,$pgn_prenom = tirage_aleatoire_du_personne_adverse()

function game(){


}
?>



<div class="game">
    <main>
        <br></br>
        <form class="dices" action="index.php" method="post">
            <button class="dice" type="DICE_CRIT"></button>
            <button class="dice" type="DICE_DEF"></button>
            <button class="dice" type="DICE_DODGE"></button>
        </form>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <div class="fighters">
            <img class="fighter" src="../images/fighter-red.jpg" alt="fighter-red.jpg"></img>
            <span class="space"></span>
            <img class="fighter" src="../images/fighter-red.jpg" alt="fighter-red.jpg"></img>
        </div>
        <br></br>
        <br></br>
        <br></br>
        <div class="report">
            <p>1</p>
            <p>2</p>
            <p>3</p>
        </div>
    </main>
    <div class="history">
        <p>History</p>
    </div>
</div>