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

// Traitement du formulaire d'ajout de cadeaux
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_gift = $_POST["nom_gift"];
    $gift_points = $_POST["gift_points"];

    // Ajouter le cadeau à la base de données
    $add_gift_query = "INSERT INTO `Gift` (`nom_gift`,`gift_points`) VALUES ('$nom_gift', '$gift_points')";
    $add_gift_result = mysqli_query($your_db_connection, $add_gift_query);

    if ($add_gift_result) {
        echo "Cadeau ajouté avec succès : $nom_gift.";
    } else {
        echo "Erreur lors de l'ajout du cadeau : " . mysqli_error($your_db_connection);
    }
}


?>

<!-- HTML pour le formulaire d'ajout de cadeaux -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <title>Ajout de Cadeaux</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Ajout de Cadeaux</h2>

<form class="col-md-6 mx-auto mt-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">

    <label for="nom_gift">Nom du Cadeau:</label>
    <input type="text" name="nom_gift" class="form-control" required>
    </div>

        <div class="form-group">

        <label for="gift_points">Points Requis:</label>
    <input type="number" name="gift_points" class="form-control" required>
        </div>

    <button type="submit" class="btn btn-primary">Ajouter un Cadeau</button>
</form>


<div class="text-center mt-3">
    <a href="profile.php" class="btn btn-secondary">Profile</a>
    <!-- Link to a page where the user can edit their profile -->
    <a href="ajouter.Points.php" class="btn btn-info">Points Ajoute Menu</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
