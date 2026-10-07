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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


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
        <a href="ADMIN.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">adnim</a>

    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        

</body>
</html>