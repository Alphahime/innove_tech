
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "innove_solution";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt_categories = $conn->query("SELECT * FROM Catégorie");
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

    $stmt_ideas = $conn->query("SELECT Idée.*, Utilisateur.Nom AS Nom_utilisateur, Catégorie.Nom_catégorie 
    FROM Idée 
    LEFT JOIN Utilisateur ON Idée.ID_utilisateur = Utilisateur.ID_utilisateur 
    LEFT JOIN Catégorie ON Idée.ID_catégorie = Catégorie.ID_catégorie");
    $ideas = $stmt_ideas->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des idées</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .category-design {
            background-color: #ffe6e6; /* Rouge clair */
        }

        .category-development {
            background-color: #e6ffe6; /* Vert clair */
        }

        .category-marketing {
            background-color: #e6e6ff; /* Bleu clair */
        }

        .action-buttons {
            margin-top: 20px;
            text-align: center;
        }

        .action-buttons form, .action-buttons a {
            display: inline-block;
            margin-right: 10px;
        }

        .action-buttons input[type="submit"], .action-buttons a {
            padding: 8px 16px;
            background-color: #007bff; /* Bleu */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .action-buttons input[type="submit"]:hover, .action-buttons a:hover {
            background-color: #007bff; 
        }

        .category-dropdown {
            margin-bottom: 20px;
        }

        .category-dropdown label {
            margin-right: 10px;
            color: #555;
        }

        .category-dropdown select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('down-arrow.png') no-repeat right;
            background-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des idées non terminées</h1>

        <div class="action-buttons">
            <form method="post">
                <input type="submit" name="create_idea" value="Créer une nouvelle idée">
                <a href="create_idea.php">Créer</a>
            </form> 
        </div>
 
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Utilisateur</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ideas as $idea): ?>
                    <tr class="category-<?php echo strtolower($idea['Nom_catégorie']); ?>">
                        <td><?php echo $idea['Titre']; ?></td>
                        <td><?php echo $idea['Description']; ?></td>
                        <td>
                            <?php 
                            // Vérifie si la catégorie est définie pour l'idée
                            if (!empty($idea['Nom_catégorie'])) {
                                echo $idea['Nom_catégorie'];
                            } else {
                                echo "Aucune catégorie définie";
                            }
                            ?>
                        </td>
                        <td>
                            <?php 
                           
                            echo isset($idea['Nom_utilisateur']) ? $idea['Nom_utilisateur'] : "Utilisateur inconnu";
                            ?>
                        </td>
                        <td>
                            <a href="edit_idea.php?id=<?php echo $idea['ID_idée']; ?>">Modifier</a>
                            <a href="delete.php?id=<?php echo $idea['ID_idée']; ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="category-dropdown">
            <form method="post">
                <label for="category">Sélectionnez une catégorie :</label>
                <select id="category" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['ID_catégorie']; ?>"><?php echo $category['Nom_catégorie']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="create_idea" value="Créer une nouvelle idée">
            </form>
        </div>
    </div>
</body>
</html>
