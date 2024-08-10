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

// Fetch the current client's points from the database
$query_points = "SELECT * FROM `Points` WHERE `code_client` = '$code_client'";
$result_points = mysqli_query($your_db_connection, $query_points);

if ($result_points) {
    $points_data = mysqli_fetch_assoc($result_points);
    $current_points = $points_data["nombre_points"];
} else {
    echo "Error fetching client points: " . mysqli_error($your_db_connection);
    exit();
}

// Handle point exchange if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gift_id = $_POST["gift_id"];
    $gift_points = $_POST["gift_points"];

    // Check if the user has enough points
    if ($current_points >= $gift_points) {
        // Deduct points from the user's balance
        $updated_points = $current_points - $gift_points;

        // Update points in the database
        $update_points_query = "UPDATE `Points` SET `nombre_points` = '$updated_points' WHERE `code_client` = '$code_client'";
        $gift_win = "SELECT * FROM `Gift` WHERE `gift_points`='$gift_points'";
        $update_points_result = mysqli_query($your_db_connection, $update_points_query);
        $result_gift = mysqli_query($your_db_connection, $gift_win);


        if ($update_points_result) {
            // Add code here to handle the gift exchange, such as updating another table with the gift information
            echo "Vos Points ont été bien échangé avec un Cadeau. ";
            $gift_data = mysqli_fetch_assoc($result_gift);
            echo "Votre Cadeau gagné est : ".$gift_data['nom_gift'];

            $insert_cadeau_query = "INSERT INTO `Cadeaux_Gagnes` (`code_client`, `gift_id`, `date_gagne`) 
                        VALUES ('$code_client', '$gift_id', NOW())";

            $insert_cadeau_result = mysqli_query($your_db_connection, $insert_cadeau_query);

        } else {
            echo "Error updating client points: " . mysqli_error($your_db_connection);
        }
    } else {
        echo "Points insuffisants pour le cadeau sélectionner.";
    }
}


$query_cadeaux_gagnes = "SELECT cadeaux_gagnes.*, Gift.nom_gift
FROM `cadeaux_gagnes`
INNER JOIN `Gift`
ON cadeaux_gagnes.gift_id=Gift.gift_id
WHERE cadeaux_gagnes.`code_client`=$code_client";

$result_cadeaux_gagnes = mysqli_query($your_db_connection, $query_cadeaux_gagnes);
if (!$result_cadeaux_gagnes) {
    echo "Erreur lors de la récupération des cadeaux gagnés : " . mysqli_error($your_db_connection);
    exit();
}

$query_gifts = "SELECT * FROM `Gift`";
$stmt_gifts = mysqli_prepare($your_db_connection, $query_gifts);
mysqli_stmt_execute($stmt_gifts);
$result_giftss = mysqli_stmt_get_result($stmt_gifts);
?>

<!-- HTML for the points exchange menu -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <title>Points Echange</title>
</head>

<body class="text-center">
<div class="container">
<br>

<h2>Echanger points contre Cadeaux </h2>
<br>

<p>Vos Points: <?php echo $current_points; ?></p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="gift_id">Select a Gift:</label>
    <!-- Add options dynamically based on your gifts table -->
    <select name="gift_id">
        <?php while ($gift_data = mysqli_fetch_assoc($result_giftss)) : ?>
            <option value="<?php echo $gift_data['gift_id']; ?>" data-points="<?php echo $gift_data['gift_points']; ?>"><?php echo $gift_data['nom_gift']; ?></option>
        <?php endwhile; ?>

        <!-- Add more options as needed -->
    </select>

    <label for="gift_points">Points Required:</label>
    <!-- Add points dynamically based on your gifts table -->
    <input type="text" name="gift_points" id="gift_points" readonly>

    <button type="submit">Exchange Points</button>
</form>

<br>
<br>

<h2>Cadeaux Gagnés ! </h2>
<br>

<?php if (mysqli_num_rows($result_cadeaux_gagnes) > 0) : ?>
    <ol>
        <?php while ($cadeau_data = mysqli_fetch_assoc($result_cadeaux_gagnes)) : ?>
            <li>
                <strong><?php echo $cadeau_data['nom_gift']; ?></strong>
                Date Gagnée : <?php echo $cadeau_data['date_gagne']; ?>
            </li>
        <?php endwhile; ?>
    </ol>
<?php else : ?>
    <p>Aucun cadeau gagné pour le moment.</p>
<?php endif; ?>


<a href="profile.php">
    <button class="mx-auto m-1 btn-sm btn btn-primary">Back to Profile</button>
</a>
    <a href="Ajouter_Points.php">
        <button class="mx-auto m-1 btn-sm btn btn-warning text-white">Add Points</button>
    </a>
    <a href="ajouter_cadeaux.php">
        <button class="mx-auto m-1 btn-sm btn btn-info text-white">Add Gifts</button>
    </a>
</div>
<script>
    // JavaScript to dynamically set points_required based on the selected gift
    document.querySelector('select[name="gift_id"]').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var pointsRequired = selectedOption.getAttribute('data-points');
        document.getElementById('gift_points').value = pointsRequired;
    });
</script>
</body>
</html>

