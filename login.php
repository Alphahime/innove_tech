<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['Email'];
    $password = $_POST['Mot_de_passe'];

    $loggedIn = true; 

    if ($loggedIn) {
        
        header("Location: create_idea.php");
        exit;
    } else {
        $error_message = "L'email ou le mot de passe est incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php
        
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="Email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="Mot_de_passe" required>
            </div>
            <div class="form-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>
            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>
        </form>
        <p>Vous n'avez pas de compte ? <a href="register.php">Inscrivez-vous ici</a>.</p>
    </div>
</body>
</html>
