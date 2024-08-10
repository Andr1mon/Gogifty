<?php
// Assuming you have a database connection established

// Check if the user is logged in
session_start();
include_once('connexiondb.php');

if (!isset($_SESSION["code_client"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: connexion.php");
    exit();
}

// Retrieve client information from the database based on the session
$code_client = $_SESSION["code_client"];
$query = "SELECT * FROM `Client` WHERE `code_client` = '$code_client'";

$query_points = "SELECT * FROM `Points` WHERE `code_client` = '$code_client'";
$query_membership = "SELECT Points.*, Membership.type_membership 
                            FROM `Points` 
                            INNER JOIN `Membership` 
                            ON Points.id_membership = Membership.id_membership 
                            WHERE Points.`code_client` = $code_client";

$query_concierge = "SELECT Points.*, Concierge.nom_concierge 
                            FROM `Points` 
                            INNER JOIN `Concierge` 
                            ON Points.id_concierge = Concierge.id_concierge 
                            WHERE Points.`code_client` = $code_client";


$result = mysqli_query($your_db_connection, $query);
$result_points = mysqli_query($your_db_connection, $query_points);
$result_membership = mysqli_query($your_db_connection, $query_membership);
$result_concierge = mysqli_query($your_db_connection, $query_concierge);

if (!$result_membership) {
    echo "Error fetching membership data: " . mysqli_error($your_db_connection);
    exit();
}

if ($result) {
    // Fetch client data
    $client_data = mysqli_fetch_assoc($result);
    $points_data = mysqli_fetch_assoc($result_points);
    $current_points = $points_data["nombre_points"];
    $membership_data = mysqli_fetch_assoc($result_membership);
    $membership_status = $membership_data["type_membership"];
    $concierge_data = mysqli_fetch_assoc($result_concierge);
    $concierge_status = $concierge_data["nom_concierge"];




} else {
    echo "Error fetching client profile: " . mysqli_error($your_db_connection);
    exit();
}

?>

<!-- HTML to display client profile -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <title>Client Profile</title>
</head>
<body>
<br>
<div class="text-center p-1"><h2 >User Profile</h2></div>

<?php if (!empty($client_data)): ?>
<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
    <div class="col-md-4 text-center">
        <img src="https://i.imgur.com/dM5kdmN.jpg" class="img-fluid rounded" style="width: 180px;height:180px;object-fit: cover;">
        <div>
                <a href="edit_profile.php">
                    <button class="mx-auto m-1 btn-sm btn btn-primary">Edit</button>
                </a>
                <a href="profile-delete.php">
                    <button class="mx-auto m-1 btn-sm btn btn-warning text-white">Delete</button>
                </a>
                <a href="deconnexion.php">
                    <button class="mx-auto m-1 btn-sm btn btn-info text-white">Déconnexion</button>
                </a>

        </div>
    </div>

<div class="col-md-8">
    <table class="table table-striped">
        <tr><th><i class="bi bi-person"></i> Nom</th><td><?php echo $client_data["nom_client"]; ?></td></tr>
        <tr><th><i class="bi bi-house"></i> Adresse</th><td><?php echo $client_data["adresse_client"]; ?></td></tr>
        <tr><th><i class="bi bi-facebook"></i> Facebook</th><td><?php echo $client_data["facebook_client"]; ?></td></tr>
        <tr><th><i class="bi bi-instagram"></i> Instagram</th><td><?php echo $client_data["instagram_client"]; ?></td></tr>
        <tr><th><i class="bi bi-envelope"></i> Email</th><td><?php echo $client_data["email_client"]; ?></td></tr>
        <tr><th><i class="bi bi-star"></i> Nombre de Points</th><td><?php echo $current_points; ?></td></tr>
        <tr><th><i class="bi bi-person-check"></i> Type Membership</th><td><?php echo $membership_status; ?></td></tr>
        <tr><th><i class="bi bi-info"></i> Information Concierge Associé</th><td><?php echo $concierge_status; ?></td></tr>
    </table>
</div>
    <?php else: ?>
        <div class="text-center alert alert-danger">Client profile not found</div>
    <?php endif; ?>


<!-- Add more profile information as needed -->
    <a href="echangepoints.php">
        <button class="mx-auto m-1 btn-sm btn btn-primary">Menu Cadeaux</button>
    </a>

<br>
<br> </br>
<!-- Button to logout -->
<form method="post" action="deconnexion.php">
    <button type="submit">Déconnexion</button>
</form>

</body>
</html>

