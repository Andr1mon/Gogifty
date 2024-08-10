<?php
// Assuming you have a database connection established

session_start();
include_once('connexiondb.php');

if (!isset($_SESSION["code_client"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

$code_client = $_SESSION["code_client"];

// Fetch the current client data from the database
$query = "SELECT * FROM `Client` WHERE `code_client` = '$code_client'";
$result = mysqli_query($your_db_connection, $query);

if ($result) {
    $client_data = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching client data: " . mysqli_error($your_db_connection);
    exit();
}

// Update the client's information if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated user input
    $nom_client = $_POST["nom_client"];
    $adresse_client = $_POST["adresse_client"];
    $facebook_client = $_POST["facebook_client"];
    $instagram_client = $_POST["instagram_client"];
    $email_client = $_POST["email_client"];

    // Update client data in the database
    $update_query = "UPDATE `Client` SET
                    `nom_client` = '$nom_client',
                    `adresse_client` = '$adresse_client',
                    `facebook_client` = '$facebook_client',
                    `instagram_client` = '$instagram_client',
                    `email_client` = '$email_client'
                    WHERE `code_client` = '$code_client'";

    $update_result = mysqli_query($your_db_connection, $update_query);

    if ($update_result) {
        // Redirect to the updated profile page
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating client profile: " . mysqli_error($your_db_connection);
    }
}
?>

<!-- HTML form for editing the client profile -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <title>Edit Profile</title>
</head>
<body>
<br>
<div class="text-center p-1"><h2 >Edit Profile</h2></div>
<?php if (!empty($client_data)): ?>
<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
    <div class="col-md-4 text-center">
        <img src="https://i.imgur.com/dM5kdmN.jpg" class="img-fluid rounded" style="width: 180px;height:180px;object-fit: cover;">
        </div>

    <div class="col-md-8">

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <table class="table table-striped">

        <tr><th> <i class="bi bi-person-circle"></i> Name: </th></tr>
        <td>
            <input type="text" name="nom_client" value="<?php echo $client_data["nom_client"]; ?>" class="form-control" required>
        </td></tr>

        <tr><th> <i class="bi bi-house"></i> Address: </th></tr>
        <td>
            <input type="text" name="adresse_client" value="<?php echo $client_data["adresse_client"]; ?>" class="form-control" required>
        </td></tr>

        <tr><th> <i class="bi bi-envelope"></i> Email: </th></tr>
        <td>
            <input type="text" name="email_client" value="<?php echo $client_data["email_client"]; ?>" class="form-control" required>
        </td></tr>

        <tr><th> <i class="bi bi-facebook"></i> Facebook: </th></tr>
        <td>
            <input type="text" name="facebook_client" value="<?php echo $client_data["facebook_client"]; ?>" class="form-control" required>
        </td></tr>

        <tr><th> <i class="bi bi-instagram"></i> Instagram: </th></tr>
        <td>
            <input type="text" name="instagram_client" value="<?php echo $client_data["instagram_client"]; ?>" class="form-control" required>
        </td></tr>

    </table>

    <button type="submit">Save Changes</button>
</form>

    </div>
    <a href="profile.php">
        <button class="mx-auto m-1 btn-sm btn btn-primary">Back to Profile</button>
    </a>
</div>

<?php else: ?>
        <div class="text-center alert alert-danger">Client profile not found</div>
    <?php endif; ?>

</body>
</html>

