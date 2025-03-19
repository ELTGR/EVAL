
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

    $j2p_pseudo= $list_pseudo[$id_perso] 
    $j2p_pv =  $list_points_de_vie[$id_perso]
    $j2p_puisssance = $list_puissance[$id_perso]
    $j2p_vitesse = $list_vitesse[$id_perso] 
    $j2p_nom = $list_nom[$id_perso] 
    $j2p_prenom = $list_prenom[$id_perso] 

    return  $j2p_pv,$j2p_puisssance,$j2p_vitesse,$j2p_nom,$j2p_prenom
}

$j2p_pv,$j2p_puisssance,$j2p_vitesse,$j2p_nom,$j2p_prenom = tirage_aleatoire_du_personne_adverse()
game($j1p_pv,$j1p_puisssance,$j1p_vitesse,$j1p_nom,$j1p_prenom,

    $j2p_pv,$j2p_puisssance,$j2p_vitesse,$j2p_nom,$j2p_prenom,)
function game($j1p_pv,$j1p_puisssance,$j1p_vitesse,$j1p_nom,$j1p_prenom,
              $j2p_pv,$j2p_puisssance,$j2p_vitesse,$j2p_nom,$j2p_prenom,){
    $j1_win = FALSE
    $j2_win = FALSE
    while($j1p_pv>0 && $j2p_pv>0){

        $j1_vitesse_tour = rand(0, $j1p_vitesse);
        $j2_vitesse_tour =rand(0, $j2p_vitesse);

        $j1_puissance_tour = rand(0, $j1p_puisssance);
        $j2_puissance_tour =rand(0, $j2p_puisssance);

        if ($j1_v_tour >$j2_v_tour){

            $j2p_pv = $j2p_pv - $j1_puissance_tour;
            if($j2p_pv <= 0 ){$j1_win = True;}

            $j1p_pv = $j1p_pv - $j2_puissance_tour;
            if($j1p_pv <= 0 ){$j2_win = True;}
        }
        else {
            $j1p_pv = $j1p_pv - $j2_puissance_tour;
            if($j1p_pv <= 0 ){$j2_win = True;}

            $j2p_pv = $j2p_pv - $j1_puissance_tour;
            if($j2p_pv <= 0 ){$j1_win = True;}
        }


    }
    if ($j1_win){
        return $j1p_nom . $j1p_prenom;
    }
    if ($j2_win){
        return $j2p_nom . $j2p_prenom;
    }
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
            <form action="game.php" method="post">
                <select class="my_button" name="Boxeur" size="1">
                <option value="monday">lundi
                <option value="tuesday"> mardi
                <option value="wednesday"> mercredi
                <option value="thursday"> jeudi
                <option value="friday"> vendredi
                </select>
                <input class="my_button" type="submit" value="Valider" />
            </form>
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