<?php



// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: p // Redirection vers la page ideas.phprofile.php');
    exit;
}

// Inclure la configuration de la base de données
require_once "config.php";

// Récupérer les informations de l'utilisateur à partir de la base de données
$userID = $_SESSION['id'];

try {
    $sql = "SELECT Nom, Email FROM Utilisateur WHERE ID_utilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $userID);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
</head>
<body>
    <h1>Profil</h1>
    <p><strong>Nom:</strong> <?php echo $user['Nom']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
    <a href="edit_profile.php">Modifier le profil</a>
    <br>
    <a href="logout.php">Déconnexion</a>
</body>
</html>
