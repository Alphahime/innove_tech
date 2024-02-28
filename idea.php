<?php
$idea_id = $_GET['ID_idee']; 
$idea_title = "Titre de l'idée"; 
$idea_description = "Description de l'idée"; 
$idea_creation_date = "2024-02-27"; 
$idea_category = "Catégorie de l'idée"; 

$logged_in = true; 

if ($logged_in && isset($_POST['complet'])) {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "innove_solution";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prépare la requête SQL
        $stmt = $connection->prepare("UPDATE Idée SET Statut = 'terminée' WHERE ID_idée = :idea_id");

        // Lie les paramètres
        $stmt->bindParam(':idea_id', $idea_id);

        // Exécute la requête
        $stmt->execute();

        // Redirige l'utilisateur vers la page de détails de l'idée
        header("Location: idea.php?id=$idea_id");
        exit;
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'idée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #007bff;
        }
        p {
            margin-bottom: 10px;
        }
        form {
            margin-top: 20px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Détails de l'idée</h1>
        <h2><?php echo $idea_title; ?></h2>
        <p>Description : <?php echo $idea_description; ?></p>
        <p>Date de création : <?php echo $idea_creation_date; ?></p>
        <p>Catégorie : <?php echo $idea_category; ?></p>

        <?php if ($logged_in): ?>
            <!-- Afficher le bouton pour marquer l'idée comme terminée -->
            <form method="post">
                <input type="submit" name="complet" value="Marquer comme terminée">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
