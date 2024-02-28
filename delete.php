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

        $stmt = $conn->prepare("DELETE FROM Idée WHERE ID_idée = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "L'idée a été supprimée avec succès.";
        header("location: ideas.php");
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
} else {
    echo "ID d'idée non spécifié.";
}
?>
