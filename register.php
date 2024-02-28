<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = $_POST['Nom'];
    $email = $_POST['Email'];
    $password = $_POST['Mot_de_passe'];

    
    $error_message = "";
    if (empty($name) || empty($email) || empty($password) ) {
        $error_message = "Veuillez remplir tous les champs.";
    } elseif ($password != $confirm_password) {
        $error_message = "Les mots de passe ne correspondent pas.";
    } else {
      
        $email_exists = false;

        if ($email_exists) {
            $error_message = "Cet email est déjà utilisé.";
        } else {
            
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <?php
      
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
        ?>
        <form method="post" action="inscription.traitement.php">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="Nom" value="<?php if (isset($name)) echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="Email" value="<?php if (isset($email)) echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="Mot_de_passe" required>
            </div>
          
            <div class="form-group">
                <button type="submit">S'inscrire</button>
            </div>
        </form>
        <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a>.</p>
    </div>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    width: 400px;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    color: #333;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button[type="submit"] {
    width: 100%;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

p {
    text-align: center;
    margin-top: 20px;
}

p a {
    color: #007bff;
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}

    </style>
</body>
</html>
