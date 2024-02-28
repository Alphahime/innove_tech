<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST['Nom'];
    $email = $_POST['Email'];
    $mot_de_passe = $_POST['Mot_de_passe'];

  
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "innove_solution"; 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $sql = "INSERT INTO Utilisateur (Nom, Email, Mot_de_passe) VALUES (:Nom, :Email, :Mot_de_passe)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Nom', $nom);
        $stmt->bindParam(':Email', $email);
        $stmt->bindParam(':Mot_de_passe', $mot_de_passe_hashed); 
        $mot_de_passe_hashed = password_hash($mot_de_passe, PASSWORD_DEFAULT); 
        $stmt->execute();

        header("Location: inscription_succes.php");
        exit;
    } catch(PDOException $e) {
      
        echo "Erreur d'inscription : " . $e->getMessage();
    }

   
    $conn = null;
}
?>
