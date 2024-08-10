<?php
session_start();
include_once('connexiondb.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["code_client"])) {
    header("Location: connexion.php");
    exit();
}

// Vérifier le rôle de l'utilisateur
$code_client = $_SESSION["code_client"];
$query_role = "SELECT role FROM `Client` WHERE `code_client` = '$code_client'";
$result_role = mysqli_query($your_db_connection, $query_role);

if ($result_role) {
    $client_data = mysqli_fetch_assoc($result_role);
    $user_role = $client_data["role"];

    // Vérifier si l'utilisateur a le rôle d'admin
    if ($user_role !== 'admin') {
        // Rediriger vers une page d'erreur ou une autre page appropriée
        header("Location: unauthorized_access.php");
        exit();
    }
} else {
    echo "Erreur lors de la vérification du rôle : " . mysqli_error($your_db_connection);
    exit();
}

// Traitement du formulaire d'ajout de points
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $points_to_add = $_POST["points_to_add"];
    $code_client1 = $_POST["code_client1"];

    // Ajouter les points au client spécifié
    $update_points_query = "UPDATE `Points` SET `nombre_points` = `nombre_points` + '$points_to_add' WHERE `code_client` = '$code_client1'";
    $update_points_result = mysqli_query($your_db_connection, $update_points_query);

    if ($update_points_result) {
        echo "Points ajoutés avec succès au client $code_client1.";
    } else {
        echo "Erreur lors de l'ajout des points : " . mysqli_error($your_db_connection);
    }
}


?>

<!-- HTML pour le formulaire d'ajout de cadeaux -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Ajout de Cadeaux</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Ajout de Points Aux Clients</h2>

<form class="col-md-6 mx-auto mt-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">

    <label for="code_client1">Code du Client:</label>
    <input type="text" name="code_client1" class="form-control"required>
    </div>

        <div class="form-group">

        <label for="points_to_add">Points à Ajouter:</label>
    <input type="number" name="points_to_add" class="form-control" required>
        </div>

    <button type="submit" class="btn btn-primary">Ajouter des Points</button>
</form>
<br>
    <div class="text-center mt-3">
        <a href="profile.php" class="btn btn-secondary">Edit Profile</a>
        <!-- Link to a page where the user can edit their profile -->
        <a href="echangepoints.php" class="btn btn-info">Points Echange Menu</a>
    </div>


</body>
</html>
