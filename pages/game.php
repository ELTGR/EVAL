
<?php 
    $user_db= new mysqli("localhost", "root", "", "data_base");
    if($user_db->connect_errno){
            die("connexion a échoué : " . $user_db->connect_error);
        }

    #on récupere le personnage choisi grace au bouton
    $id_jp1 = isset($_POST['Boxeur']) ? $_POST['Boxeur']: 0;
    $sql_get_j1p = "SELECT * FROM `personnages`WHERE id = $id_jp1;";
    $j1p = $user_db->query($sql_get_j1p);

#fonction qui permet de tirer un personnage adverse aléatoirement au debut d'un combat
    function tirage_aleatoire_du_personne_adverse(){
        $user_db= new mysqli("localhost", "root", "", "data_base");
        if($user_db->connect_errno){
                die("connexion a échoué : " . $user_db->connect_error);
            }


        $sql_get_personnage = "SELECT * FROM `personnages`;";
        echo $sql_get_personnage;
        $personnage_data = $user_db->query($sql_get_personnage);

        $list_pseudo  = array("");
        $list_puissance  = array("");
        $list_points_de_vie  = array("");
        $list_vitesse  = array("");
        $list_nom  = array("");
        $list_prenom  = array("");
        while ($row = mysqli_fetch_assoc($personnage_data)) {
            array_push($list_pseudo, $row['pseudonyme']);
            array_push($list_puissance, $row['puissance']);
            array_push($list_points_de_vie, $row['points_de_vie']);
            array_push($list_vitesse, $row['vitesse']);
            array_push($list_nom, $row['nom']);
            array_push($list_prenom, $row['prenom']);
        }

        $max_id = count($list_pseudo);
        $id_perso = rand(0, $max_id);

        $j2p_pseudo= $list_pseudo[$id_perso] ;
        $j2p_pv =  $list_points_de_vie[$id_perso];
        $j2p_puisssance = $list_puissance[$id_perso];
        $j2p_vitesse = $list_vitesse[$id_perso] ;
        $j2p_nom = $list_nom[$id_perso] ;
        $j2p_prenom = $list_prenom[$id_perso] 
        ;
        $j2p = array("$j2p_pv","$j2p_puisssance","$j2p_vitesse","$j2p_nom","$j2p_prenom","$j2p_pseudo");
        return $j2p;
    }

    function game($j1p,$j2p){
        
        $j1p_vitesse = $j1p[2];
        $j1p_puisssance= $j1p[1];
        $j1p_pv= $j1p[0];
        $j1p_pseudo= $j1p[5];

        $j2p_vitesse = $j2p[2];
        $j2p_puisssance= $j2p[1];
        $j2p_pv= $j2p[0];
        $j2p_pseudo= $j2p[5];

        $j1p_win = FALSE;
        $j2p_win = FALSE;

        $j1_vitesse_tour = rand(0, $j1p_vitesse);
        $j2_vitesse_tour =rand(0, $j2p_vitesse);

        $j1_puissance_tour = rand(0, $j1p_puisssance);
        $j2_puissance_tour =rand(0, $j2p_puisssance);

        if ($j1_vitesse_tour >$j2_vitesse_tour){
            echo "J1 joue en premier.\n";
            $j2p_pv = $j2p_pv - $j1_puissance_tour;
            echo "pv J2 :".$j2p_pv.".\n";
            if($j2p_pv <= 0 ){$j1p_win = True;echo "J2 : MORT.\n";}

            $j1p_pv = $j1p_pv - $j2_puissance_tour;
            echo "pv J1 :".$j1p_pv.".\n";
            if($j1p_pv <= 0 ){$j2p_win = True;echo "J1 : MORT.\n";}
        }
        else {

            echo "J2 joue en premier.\n";
            $j1p_pv = $j1p_pv - $j2_puissance_tour;
            echo "pv J1 :".$j1p_pv.".\n";
            if($j1p_pv <= 0 ){$j2p_win = True;echo "J1 : MORT.\n";}

            $j2p_pv = $j2p_pv - $j1_puissance_tour;
            echo "pv J2 :".$j2p_pv.".\n";
            if($j2p_pv <= 0 ){$j1p_win = True;echo "J2 : MORT.\n";}
        }
        
    }
    $j2p= tirage_aleatoire_du_personne_adverse();

    $j1p = $j2p;
    game($j1p,$j2p)

?>



<div class="game">
    <main>
        <br></br>
        <p class="report"> Tour 1</p>
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
            <form action="index.php" method="post">
                <select class="my_button" name="Boxeur" size="1">
                <option value="0"> Bastien
                <option value="1"> Grael
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