<?php

$category_id = $_GET['ID_categorie'];


$logged_in = true; 

if ($logged_in && isset($_POST['add_new_idea'])) {
   
    header("Location: create_idea.php?category_id=$category_id");
     exit;

     $category_id = $_GET['category_id'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la catégorie</title>
    
</head>
<body>
    <h1>Détails de la catégorie</h1>
    <?php
 
    $category_name = "Nom de la catégorie"; 
    echo "<h2>$category_name</h2>";
    ?>

  
    <?php if ($logged_in): ?>
        <form method="post">
            <input type="submit" name="add_new_idea" value="Ajouter une nouvelle idée">
        </form>
    <?php endif; ?>

    
    <h2>Idées associées</h2>
    <ul>
        <?php
     
        
        foreach ($ideas as $idea) {
            echo "<li>{$idea['Titre']}</li>";
        }
        
        ?>
    </ul>
</body>
</html>
