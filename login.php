<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Mot_de_passe'];

    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "innove_solution";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'utilisateur existe dans la base de données
        $stmt = $conn->prepare("SELECT * FROM Utilisateur WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['Mot_de_passe'])) {
                // Authentification réussie, démarrer la session
                $_SESSION["loggedin"] = true;
                $_SESSION["ID_utilisateur"] = $user['ID_utilisateur'];
                $_SESSION["Nom"] = $user['Nom'];
                $_SESSION["Email"] = $user['Email'];
                header("location: create_idea.php");
                exit;
            } else {
                // Mot de passe incorrect
                $error_message = "L'email ou le mot de passe est incorrect.";
            }
        } else {
            // Utilisateur non trouvé
            $error_message = "L'email ou le mot de passe est incorrect.";
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
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
                <button type="submit">Se connecter</button>
            </div>
        </form>
        <p>Vous n'avez pas de compte ? <a href="register.php">Inscrivez-vous ici</a>.</p>
    </div>
</body>
</html>
