<?php
// Assuming you have a database connection established

session_start();
include_once('connexiondb.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email_client = $_POST["email_client"];
    $password = $_POST["password"];

    // Check user credentials
    $query = "SELECT * FROM `Client` WHERE `email_client` = '$email_client'";
    $result = mysqli_query($your_db_connection, $query);

    if ($result) {
        // Fetch user data
        $client_data = mysqli_fetch_assoc($result);

        // Verify password
        if ($client_data && password_verify($password, $client_data["password"])) {
            // Authentication successful, set session variables
            $_SESSION["code_client"] = $client_data["code_client"];
            header("Location: profile.php");
            exit();
        } else {
            $login_error = "Invalid email or password";
        }
    } else {
        echo "Error checking credentials: " . mysqli_error($your_db_connection);
        exit();
    }
}

?>

<!-- HTML for the login form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body>
<div class="container login-container">

<h2>Login</h2>

<?php
if (isset($login_error)) {
    echo "<p style='color: red;'>$login_error</p>";
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">

    <label for="email_client">Email:</label>
    <input type="email" name="email_client" required>
    </div>
    <div class="form-group">

    <label for="password">Password:</label>
    <input type="password" name="password" required>
</div>

    <button type="submit">Se connecter</button>
</form>

<p>Vous n'avez pas de compte ? <a href="inscription.php">S'inscrire</a>.</p>
<!-- Link to a page where users can register -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container form {
            margin-top: 20px;
        }

        .login-container label {
            font-weight: bold;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container p {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</body>
</html>
