<?php
// Connexion à la base de données (adapté à votre code)
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa"; // Remplacez par le nom de votre base de données

// Activer le signalement des erreurs
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connexion à la base de données
$dbhandle = mysqli_connect($hostname, $username, $password, $dbname);

// Vérifier si le formulaire est soumis
if (isset($_POST['register-submition'])) {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Si les champs ne sont pas vides, insérer les données dans la base
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Définition de la requête + exécution de la requête
        $result = mysqli_query($dbhandle, "INSERT INTO `user` (username, email, password) VALUES ('$username', '$email', '$password');");
    }
}

// Fermer la connexion
mysqli_close($dbhandle);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crée compte</title>
    <link rel="icon" href="img1.png" type="image/x-icon"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div >
        <img src="logo.jpg" alt="img" class="logo" >
  </div>
  <img src="Computer.png" alt="img" class="photo2">
 
  <div class="container">
    <div class="content">
      <img src="sign.png" alt="sign" class="password">
      <h2> <span>Créez</span> votre compte</h2>
      <form method="post"  name="login-form">


<p class="success register-success"></p>

        <input type="text" id="username" placeholder="Username" name="username" >
        <p class="error username-error"></p>
        <br>
        <input type="email" id="email" placeholder="Email" name="email" >
       <p class="error email-error"></p>
        <br>
        <input type="password" id="password" placeholder="Password" name="password">
        <p class="error password-error"></p>
        <p>Vous êtes déjà enregistré</p>
        <a href="connexion.php">Connexion</a><br>
        <input type="submit" value="S'inscrire" name="register-submition" onclick="verif()" >
        <p class="error register-error"></p>
      </form>
    </div>
  </div>
  

  <script>
function verif() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (username === "") {
        alert("Please enter your username.");
        document.getElementById("username").focus();
        return false;
    }

    if (email === "") {
        alert("Please enter your email address.");
        document.getElementById("email").focus();
        return false;
    }

   

    if (password === "") {
        alert("Please enter your password.");
        document.getElementById("password").focus();
        return false;
    }

    return true; // Form is valid
}
</script>

</body>
</html>