<?php
// Connexion à la base de données (à personnaliser)
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa";

// Créez une connexion à la base de données
$mysqli = new mysqli($hostname, $username, $password, $dbname);

// Vérifiez si la connexion à la base de données a réussi
if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}

// Vérifiez si le formulaire a été soumis
if (isset($_POST['update'])) {
    // Récupérez l'ID de la tâche à mettre à jour
    $id = $_POST['id'];

    // Récupérez les données existantes de la base de données en fonction de l'ID
    $query = "SELECT * FROM taches WHERE `id` = $id";
    $result = $mysqli->query($query);

    // Vérifiez s'il y a des résultats
    if ($result->num_rows > 0) {
        $taches = $result->fetch_assoc();
        
        // Récupérez les valeurs du formulaire et échappez-les
        $name = mysqli_real_escape_string($mysqli, $_POST['name']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $description = mysqli_real_escape_string($mysqli, $_POST['description']);
        $date_debut = mysqli_real_escape_string($mysqli, $_POST['date_debut']);
        $date_fin = mysqli_real_escape_string($mysqli, $_POST['date_fin']);

        // Vérifiez si des champs obligatoires sont vides
        $errors = [];
        if (empty($name)) {
            $errors[] = "Le champ Name est vide.";
        }
        if (empty($email)) {
            $errors[] = "Le champ Email est vide.";
        }
        if (empty($description)) {
            $errors[] = "Le champ Description est vide.";
        }
        if (empty($date_debut)) {
            $errors[] = "Le champ Date de début est vide.";
        }
        if (empty($date_fin)) {
            $errors[] = "Le champ Date de fin est vide.";
        }

        if (!empty($errors)) {
            // S'il y a des erreurs, affichez-les
            foreach ($errors as $error) {
                echo "<font color='red'>$error</font><br/>";
            }
        } else {
            // Mettez à jour la table de la base de données
            $update_query = "UPDATE taches SET `name` = '$name', `email` = '$email', `description` = '$description', `date_debut` = '$date_debut', `date_fin` = '$date_fin' WHERE `id` = $id";
            if ($mysqli->query($update_query) === TRUE) {
                // Affichez un message de succès
                echo "<p><font color='green'>Données mises à jour avec succès !</font></p>";
                echo "<a href='index.php'>Voir le résultat</a>";
            } else {
                // En cas d'erreur de requête SQL
                echo "Erreur lors de la mise à jour des données : " . $mysqli->error;
            }
        }
    } else {
        echo "Tâche introuvable avec l'ID spécifié.";
    }

    // Fermez la connexion à la base de données
    $mysqli->close();
}
?>
