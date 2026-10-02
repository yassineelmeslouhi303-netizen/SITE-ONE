<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "riade_el_hamde";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    $conn->query("DELETE FROM inscriptions WHERE id = $id");
    header("Location: ADMIN.php");
    exit;
}

$sql = "SELECT * FROM inscriptions ORDER BY date_inscription DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Administration</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #222;
            color: white;
        }
    </style>
</head>

<body>

<h1>📋 Liste des inscriptions</h1>

<table>

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Abonnement</th>
        <th>Prix</th>
        <th>Assurance</th>
        <th>Total</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        
        echo "<tr>";

        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['abonnement']) . "</td>";
        echo "<td>" . $row['prix'] . " DH</td>";
        echo "<td>" . $row['assurance'] . " DH</td>";
        echo "<td>" . $row['total'] . " DH</td>";
        echo "<td>" . $row['date_inscription'] . "</td>";
        echo "<td>
        <a href='admin.php?delete=" . $row['id'] . "'
           onclick=\"return confirm('Voulez-vous supprimer cette inscription ?')\">
           Supprimer
        </a>
      </td>";
        echo "</tr>";
    }

} else {

    echo "<tr><td colspan='9'>Aucune inscription</td></tr>";
}

?>

</table>

</body>
</html>

<?php
$conn->close();
?>