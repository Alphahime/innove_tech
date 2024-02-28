<?php
// Inclure le fichier de configuration de la base de données
require_once "config.php";

// Récupérer les catégories depuis la base de données
try {
    $sql = "SELECT ID_catégorie, Nom_catégorie FROM Catégorie";
    $stmt = $connection->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erreur de récupération des catégories: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une nouvelle idée</title>
    <!-- Lien vers votre fichier CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Créer une nouvelle idée</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <!-- Ajoutez ici d'autres liens de navigation si nécessaire -->
            </ul>
        </nav>
    </header>
    <main>
        <h2>Formulaire de création d'idée</h2>
        <!-- Formulaire pour créer une nouvelle idée -->
        <form action="create_idea.php" method="post">
            <div>
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="Titre" required>
            </div>
            <div>
                <label for="description">Description :</label>
                <textarea id="description" name="Description" rows="4" required></textarea>
            </div>
            <div>
                <label for="categorie">Catégorie :</label>
                <select id="categorie" name="categorie" required>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['ID_catégorie']; ?>"><?php echo $categorie['Nom_catégorie']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit">Créer</button>
            </div>
        </form>
    </main>
    <footer>
        <p>&copy; Votre entreprise 2024</p>
    </footer>
</body>
</html>
