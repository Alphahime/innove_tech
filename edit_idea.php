<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "innove_solution";

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM Idée WHERE ID_idée = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $idea = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$idea) {
            echo "L'idée avec cet ID n'existe pas.";
            exit();
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
} else {
    echo "ID d'idée non spécifié.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une idée</title>
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
</head>
<body>
    <div class="container">
        <h1>Modifier une idée</h1>
        <form method="post">
            <div>
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" value="<?php echo $idea['Titre']; ?>" required>
            </div>
            <div>
                <label for="description">Description :</label>
                <textarea id="description" name="description" required><?php echo $idea['Description']; ?></textarea>
            </div>
            <div>
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</body>
</html>
