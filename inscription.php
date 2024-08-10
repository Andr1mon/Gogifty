<?php
// Assuming you have a database connection established
session_start();
include_once('connexiondb.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $nom_client = $_POST["nom_client"];
    $adresse_client = $_POST["adresse_client"];
    $facebook_client = $_POST["facebook_client"];
    $instagram_client = $_POST["instagram_client"];
    $email_client = $_POST["email_client"];
    $password = $_POST["password"];

    // Hash the password (use a secure hashing algorithm)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the 'Client' table
    $query = "INSERT INTO `client` (`nom_client`, `adresse_client`, `facebook_client`, `instagram_client`, `email_client`, `password`) 
              VALUES ('$nom_client', '$adresse_client', '$facebook_client', '$instagram_client', '$email_client', '$hashed_password')";

    // Execute the query
    $result = mysqli_query($your_db_connection, $query);

    if ($result) {
        echo "Account created successfully!";
        // You can redirect the user to a login page or any other page here

    } else {
        echo "Error creating account: " . mysqli_error($your_db_connection);
    }
}

?>

<!-- HTML form for user registration -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <title>User Registration</title>
</head>
<body>
<div class="container registration-container">

<h2>Créer un Compte</h2>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">

    <label for="nom_client">Name:</label>
    <input type="text" name="nom_client" required>
    </div>

    <div class="form-group">

    <label for="adresse_client">Address:</label>
    <input type="text" name="adresse_client" required>
    </div>

    <div class="form-group">

    <label for="facebook_client">Facebook:</label>
    <input type="text" name="facebook_client" required>
    </div>

    <div class="form-group">

    <label for="instagram_client">Instagram:</label>
    <input type="text" name="instagram_client" required>
    </div>

    <div class="form-group">

    <label for="email_client">Email:</label>
    <input type="email" name="email_client" required>
    </div>

    <div class="form-group">

    <label for="password">Password:</label>
    <input type="password" name="password" required>
    </div>


    <button type="submit">S'enregistrer</button>
</form>
<style>
    body {
        background-color: #f8f9fa;
    }

    .registration-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }

    .registration-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .registration-container form label {
        font-weight: bold;
    }

    .registration-container form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    .registration-container form button {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
