<?php
// Détruire la session
session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
    <title>Logout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="text-center">
<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Vous êtes déconnecté</h1>
        <p class="lead">Merci de vous reconnecter pour accéder à votre compte.</p>
        <hr class="my-4">
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="connexion.php" role="button">Se reconnecter</a>
        </p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

