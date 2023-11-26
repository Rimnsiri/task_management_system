<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecter</title>
    <link rel="icon" href="img1.png" type="image/x-icon"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <img src="logo.jpg" alt="img" class="logo">
    </div>
    <img src="login.png" alt="login" class="photo1">

    <div class="container">
        <div class="content">
            <img src="pass.png" alt="pass" class="password">
            <h2><span>Connecter</span> a votre compte</h2>
            <form action="" method="POST"> <!-- Ajout de method="POST" ici -->
                <input type="text" id="username" placeholder="username" name="username" require>
                <br>
                <input type="password" id="password" placeholder="Password" name="password">
                <p>Pas encore enrégistré ?</p>
                <a href="login.php">S'inscrire</a><br>
                <input type="submit" value="Connecter">
            </form>
            <div class="error-message">
            <?php
session_start();

// Connexion à la base de données (adapté à votre code)
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa"; // Remplacez par le nom de votre base de données

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connexion à la base de données
try {
    $dbhandle = new mysqli($hostname, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si le nom d'utilisateur et le mot de passe sont définis
    if (isset($_POST['username']) && isset($_POST['password'])) {
     
        $username = $dbhandle->real_escape_string($_POST['username']);
        $password = $dbhandle->real_escape_string($_POST['password']);

        // Modifiez la requête SQL pour utiliser $username au lieu de $email
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = $dbhandle->query($sql);

        if ($result && $result->num_rows == 1) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header('Location: dash.php');
            exit;
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}

$dbhandle->close();
?>
            </div>
        </div>
    </div>


    <script>

    const errorMessage = document.querySelector('.error-message');
    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 4000); 
    }



    
    </script>
</body>
</html>
