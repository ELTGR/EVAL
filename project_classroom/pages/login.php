<main>
    <div class="login">
        <h2>Connexion</h2>
        <form class="inputs" action="index.php" method="post">
            <input class="my_button" type="text" name="pseudo_connexion" placeholder="Pseudo" required>
            <input class="my_button" type="password" name="password_connexion" placeholder="Mot de passe" required>
            <button type="submit" name ="connexion"  value ="1">Se connecter</button>
        </form>
    </div>
    <div class="login">
        <h2>inscription</h2>
        <form class="inputs" action="index.php" method="post">
            <input class="my_button" type="email" name="email_inscription" placeholder="Email" required>
            <input class="my_button" type="text" name="pseudo_inscription" placeholder="Pseudo" required>
            <input class="my_button" type="password" name="password_inscription" placeholder="Mot de passe" required>
            <button type="submit" name ="inscription"  value ="1">Se connecter</button>
        </form>
    </div>
</main>