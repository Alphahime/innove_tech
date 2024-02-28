<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "innove_solution";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['Titre']) && isset($_POST['Description']) && isset($_POST['category_id'])) {
        $title = $_POST['Titre'];
        $description = $_POST['Description'];
        $category_id = $_POST['category_id'];
        
        $user_id = 1; 

        $sql = "SELECT ID_catégorie FROM Catégorie WHERE Nom_catégorie = :category_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $category_id = $result['ID_catégorie'];

        $stmt = $conn->prepare("INSERT INTO Idée (Titre, Description, Date_de_création, ID_catégorie, ID_utilisateur) VALUES (:title, :description, NOW(), :category_id, :user_id)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if($stmt->execute()) {
            
            header("Location: ideas.php");
            exit(); 
        }
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une nouvelle idée</title>
   
</head>
<body>
    <h1>Créer une nouvelle idée</h1>
    <form method="post">
        <div>
            <label for="title">Titre :</label>
            <input type="text" id="title" name="Titre" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="Description" required></textarea>
        </div>
        <div>
            <label for="category">Catégorie :</label>
            <select id="category" name="category_id" required>
                <option value="1">Design</option>
                <option value="2">Development</option>
                <option value="3">Marketing</option>
                <!-- Ajoutez d'autres options selon vos catégories existantes -->
            </select>
        </div>
        <div>
            <button type="submit">Créer</button>
        </div>
    </form>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
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

form {
    max-width: 500px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

select {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url('down-arrow.png') no-repeat right;
    background-size: 24px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</style>
</body>
</html>