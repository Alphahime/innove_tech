<?php

// Informations de connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=innove_solution';
$username = 'root';
$password = '';

try {
    
    $pdo = new PDO($dsn, $username, $password);
    // Configureration du PDO pour qu'il génère des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupéreration des utilisateurs
    $utilisateurs = array();
    $stmt_utilisateurs = $pdo->query("SELECT * FROM Utilisateur");
    while ($row = $stmt_utilisateurs->fetch(PDO::FETCH_ASSOC)) {
        $utilisateurs[] = $row;
    }

    // Récupéreration des catégories
    $categories = array();
    $stmt_categories = $pdo->query("SELECT * FROM Catégorie");
    while ($row = $stmt_categories->fetch(PDO::FETCH_ASSOC)) {
        $categories[] = $row;
    }

    // Récupéreration des idées
    $idées = array();
    $stmt_idées = $pdo->query("SELECT * FROM Idée");
    while ($row = $stmt_idées->fetch(PDO::FETCH_ASSOC)) {
        $idées[] = $row;
    }

    // Fermeture de la connexion PDO
    $pdo = null;
} catch (PDOException $e) {
    // Les erreurs de connexion PDO
    echo "Erreur de connexion : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles CSS spécifiques à cette page */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
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

    </style>
</head>
<body>
    <header>
        <h1>Bienvenue à Innove Tech Solution</h1>
        <nav>
            <ul>
                <li><a href="login.php">Se connecter</a></li>
                <li><a href="register.php">S'inscrire</a></li>
                <li><a href="idea.php">Details de l'idée</a></li>
                <li><a href="ideas.php">Liste des idées non terminées</a></li>
                <li><a href="category.php">Details de la catégorie</a></li>
            </ul>
        </nav>

        
        <style>

            
            header {
    background-color: #007bff;
    color: #fff;
    padding: 20px; 
    text-align: center; 
}

h1 {
    margin: 0; /
}

nav ul {
    list-style-type: none; 
    padding: 0; 
}

nav ul li {
    display: inline;
    margin-right: 20px; 
}

nav ul li a {
    color: #fff; 
    text-decoration: none; 
}

nav ul li a:hover {
    text-decoration: underline; 
    
}


        </style>
    </header>
    <main>
        <!-- Affichage du tableau d'idées non terminées -->
        <h2>Idées non terminées</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Catégorie</th>
            </tr>

            
            <?php
   
            $ideas = array(
                array("Prototypage", "Ceci conecerne la mise en place des maquettes graphiques conviviales", "design"),
                array("Création de site web", "Cet idée s'appuie sur la création de site web securisée avec une interface utilisateur facile et fluide", "development"),
                array("Faire passer le produit", "Le marketing nous permet de faire passer nos produit au grand public", "marketing")
            );

            foreach ($ideas as $idea) {
                $title = $idea[0];
                $description = $idea[1];
                $category = $idea[2];
                $categoryClass = "category-" . $category;
                echo "<tr class='$categoryClass'><td>$title</td><td>$description</td><td>$category</td></tr>";
            }
            ?>
        </table>
        
        <?php
        
        // On verifie si l'utilisateur est connecté et affichez le formulaire en conséquence
        $loggedIn = false; 
        if ($loggedIn) {
            echo "<h2>Créer une nouvelle idée</h2>";
            echo "<form action='create_idea.php' method='post'>";
            echo "<label for='title'>Titre :</label><br>";
            echo "<input type='text' id='title' name='title'><br>";
            echo "<label for='description'>Description :</label><br>";
            echo "<textarea id='description' name='description'></textarea><br>";
            echo "<label for='category'>Catégorie :</label><br>";
            echo "<select id='category' name='category'>";
            echo "<option value='design'>Design</option>";
            echo "<option value='development'>Development</option>";
            echo "<option value='marketing'>Marketing</option>";
            echo "</select><br>";
            echo "<input type='submit' value='Créer'>";
            echo "</form>";
        }
        ?>
    </main>
    <footer>
        <!-- Pied de page -->
    </footer>
</body>
</html>
