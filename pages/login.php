<div class="login">
    <main>
        <h2>Connexion</h2>
        <form class="inputs" action="index.php" method="post">
            <input class="my_button" type="text" name="pseudo_connexion" placeholder="Pseudo" required>
            <input class="my_button" type="password" name="password_connexion" placeholder="Mot de passe" required>
            <button type="my_button" name ="connexion"  value ="1">Se connecter</button>
        </form>
        <h2>inscription</h2>
        <form class="inputs" action="index.php" method="post">
            <input class="my_button" type="text" name="prenom_inscription" placeholder="Prenom" required>
            <input class="my_button" type="text" name="nom_inscription" placeholder="Nom" required>
            <select class="my_button" name="genre_inscription" size="1">
                <option value="Homme">Homme
                <option value="Femmme"> Femmme
            </select>
            <input class="my_button" type="email" name="email_inscription" placeholder="Email" required>
            <input class="my_button" type="password" name="password_inscription" placeholder="Mot de passe" required>
            <button type="my_button" name ="inscription"  value ="1">S'inscrire</button>
        </form>
    </main>
</div>
