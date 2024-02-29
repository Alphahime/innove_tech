<?php
session_start();

if (!isset($_SESSION["ID_utilisateur"]) || $_SESSION["ID_utilisateur"] !== true) {
    header("location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "innove_solution";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT * FROM Idée");
    $ideas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des idées</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de création</th>
                <th>Statut</th>
                <th>ID utilisateur</th>
                <th>ID catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ideas as $idea): ?>
                <tr>
                    <td><?php echo $idea['ID_idée']; ?></td>
                    <td><?php echo $idea['Titre']; ?></td>
                    <td><?php echo $idea['Description']; ?></td>
                    <td><?php echo $idea['Date_de_création']; ?></td>
                    <td><?php echo $idea['Statut']; ?></td>
                    <td><?php echo $idea['ID_utilisateur']; ?></td>
                    <td><?php echo $idea['ID_catégorie']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
