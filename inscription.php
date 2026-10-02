<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "riade_el_hamde";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$abonnement = $_GET['abonnement'] ?? '';
$prix = $_GET['prix'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];

    $assurance = 130;
    $total = $prix + $assurance;

    $sql = "INSERT INTO inscriptions 
            (nom, prenom, telephone, abonnement, prix, assurance, total)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssddd",
        $nom,
        $prenom,
        $telephone,
        $abonnement,
        $prix,
        $assurance,
        $total
    );

    if ($stmt->execute()) {
        echo '
<div class="inscription-container">

    <h1>✅ Inscription réussie</h1>

    <div class="inscription-info">
        <p><strong>Nom :</strong> ' . htmlspecialchars($nom) . '</p>
        <p><strong>Prénom :</strong> ' . htmlspecialchars($prenom) . '</p>
        <p><strong>Téléphone :</strong> ' . htmlspecialchars($telephone) . '</p>
        <p><strong>Abonnement :</strong> ' . htmlspecialchars($abonnement) . '</p>
        <p><strong>Prix :</strong> ' . $prix . ' DH</p>
        <p><strong>Assurance :</strong> ' . $assurance . ' DH</p>
        <p><strong>Total :</strong> ' . $total . ' DH</p>
    </div>

    <a href="Abonnement.html" class="btn">Retour aux abonnements</a>

</div>';
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="inscription-container">

    <h1>Inscription</h1>

    <form method="POST">

        <label>Nom :</label>
        <input type="text" name="nom" placeholder="Votre nom" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" placeholder="Votre prénom" required>

        <label>Téléphone :</label>
        <input type="text" name="telephone" placeholder="Votre téléphone" required>

        <div class="inscription-info">
            <p><strong>Abonnement :</strong> <?php echo htmlspecialchars($abonnement); ?></p>
            <p><strong>Prix :</strong> <?php echo htmlspecialchars($prix); ?> DH</p>
            <p><strong>Assurance :</strong> 130 DH</p>
            <p><strong>Total :</strong> <?php echo $prix + 130; ?> DH</p>
        </div>

        <button type="submit">S'inscrire</button>
        <a href="ADMIN.php">adnim</a>

    </form>

</div>
        

</body>
</html>