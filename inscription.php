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
    $email = trim($_POST['email']);
$date_naissance = $_POST['date_naissance'];

// Calculer l'âge
$dateNaissance = new DateTime($date_naissance);
$aujourdhui = new DateTime();

$age = $aujourdhui->diff($dateNaissance)->y;

// Déterminer la catégorie
$categorie = ($dateNaissance <= $aujourdhui && $age >= 18)
    ? "Adulte"
    : "Mineur";
$dateNaissance = DateTime::createFromFormat('!Y-m-d', $date_naissance);
$aujourdhui = new DateTime('today');

if (!$dateNaissance || $dateNaissance > $aujourdhui) {
    die("Date de naissance invalide.");
}

$age = $dateNaissance->diff($aujourdhui)->y;
$categorie = ($age >= 18) ? "Adulte" : "Mineur";

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];

    $assurance = 130;
    $total = $prix + $assurance;

    $sql = "INSERT INTO inscriptions
(nom, prenom, telephone, email, date_naissance,
 categorie, abonnement, prix, assurance, total)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssssddd",
    $nom,
    $prenom,
    $telephone,
    $email,
    $date_naissance,
    $categorie,
    $abonnement,
    $prix,
    $assurance,
    $total
);

    if ($stmt->execute()) {
        echo '
<div class="inscription-container">s
    <h1>✅ Inscription réussie</h1>
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
        <label>Email :</label>
        <input
            type="email"
            name="email"
            placeholder="Votre email"
            required
        >

        <label>Date de naissance :</label>
        <input
            type="date"
            name="date_naissance"
            max="<?php echo date('Y-m-d'); ?>"
            required
        >

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