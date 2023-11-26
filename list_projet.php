

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        gestion des taches
    </title>
    <link rel="icon" href="img1.png" type="image/x-icon"> 
    <link rel="shortcut icon" href="/images/logo-mb.png" type="image/png">
    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- APP CSS -->
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/app.css">
    
    
</head>
<?php
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit;
}

// Récupérez le nom d'utilisateur depuis la session
$username = $_SESSION['username'];

// Connexion à la base de données (si nécessaire)
// ...

?>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="./images/logo.jpg" alt="Comapny logo">
            <div class="sidebar-close" id="sidebar-close">
                <i class='bx bx-left-arrow-alt'></i>
            </div>
        </div>
        <div class="sidebar-user">
        <div class="sidebar-user-info">
            <img src="./images/sign.png" alt="User picture" class="profile-image">
            <div class="sidebar-user-name">
                <?php echo $username; ?>
            </div>
        </div>
        <a href="logout.php" class="btn btn-outline" style="font-size: 12px;">Déconnecter</a>
    </div>
        <!-- SIDEBAR MENU -->
        <ul class="sidebar-menu">
            <li>
                <a href="dash.php" class="active">
                    <i class='bx bx-home'></i>
                    <span>dashboard</span>
                </a>
            </li>
        
           
            <li class="sidebar-submenu">
                <a href="#" class="sidebar-menu-dropdown">
                    <i class='bx bx-user-circle'></i>
                    <span>account</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content">
                    <li>
                        <a href="edite_compte.php">
                            edit profile
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            account settings
                        </a>
                    </li>
                
                </ul>
            </li>
            <li class="sidebar-submenu">
                <a href="#" class="sidebar-menu-dropdown">
                    <i class='bx bx-plus-circle'></i>
                    <span>projets</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content">
                  
                    <li>
                        <a href="#" id="popup-link">
                            Ajouter projet
                        </a>
                    </li>
                    <li>
                        <a href="#" id="popup-link">
                            list projets
                        </a>
                    </li>
                </ul>
            </li>
            
        
            <li>
                <a href="#">
                    <i class='bx bx-mail-send'></i>
                    <span>mail</span>
                </a>
            </li>
          
            <li>
                <a href="events.php">
                    <i class='bx bx-calendar'></i>
                    <span>calendar</span>
                </a>
            </li>
       
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->

    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="main-header">
            <div class="mobile-toggle" id="mobile-toggle">
                <i class='bx bx-menu-alt-right'></i>
            </div>
            <div class="main-title">
              Projets
            </div>
            
        </div>
        <div class="main-content">
            
          

            
            <div class="row">
            <?php
// Connexion à la base de données (à personnaliser)
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa"; // Remplacez par le nom de votre base de données

// Activer le signalement des erreurs
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connexion à la base de données
$dbhandle = mysqli_connect($hostname, $username, $password, $dbname);

// Vérifier la connexion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Requête SQL pour supprimer la tâche en fonction de l'ID
    $delete_sql = "DELETE FROM taches WHERE id = $delete_id";
    if (mysqli_query($dbhandle, $delete_sql)) {
        // Suppression réussie
        echo "projet supprimée avec succès.";

        // Redirection vers la page d'accueil après 5 secondes
        echo '<script>setTimeout(function() { window.location.href = "list_projet.php"; }, 5000);</script>';
    } else {
        echo "Erreur lors de la suppression de la projet : " . mysqli_error($dbhandle);
    }
}

// Initialiser les variables pour le formulaire
$id = "";
$titre = "";
$email = "";
$description = "";
$date_debut = "";
$date_fin = "";

// Vérifier si un ID est passé dans l'URL pour l'édition
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Requête SQL pour récupérer les données de la tâche en fonction de l'ID
    $sql = "SELECT * FROM taches WHERE id = $id";
    $result = mysqli_query($dbhandle, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $tache = mysqli_fetch_assoc($result);
        $titre = $tache['titre'];
        $email = $tache['email'];
        $description = $tache['description'];
        $date_debut = $tache['date_debut'];
        $date_fin = $tache['date_fin'];
    } else {
        echo "Aucune tâche trouvée avec cet ID.";
        exit;
    }
}

// Traitement du formulaire d'édition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si l'ID est présent dans la requête
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($dbhandle, $_POST['id']);
        $titre = mysqli_real_escape_string($dbhandle, $_POST['titre']);
        $email = mysqli_real_escape_string($dbhandle, $_POST['email']);
        $description = mysqli_real_escape_string($dbhandle, $_POST['description']);
        $date_debut = mysqli_real_escape_string($dbhandle, $_POST['date_debut']);
        $date_fin = mysqli_real_escape_string($dbhandle, $_POST['date_fin']);

        // Requête SQL pour mettre à jour la tâche dans la base de données
        $sql = "UPDATE taches SET titre = '$titre', email = '$email', description = '$description', date_debut = '$date_debut', date_fin = '$date_fin' WHERE id = $id";

        if (mysqli_query($dbhandle, $sql)) {
            // Mise à jour réussie
            echo "projet mise à jour avec succès.";

            // Redirection vers la page d'accueil après 5 secondes
            echo '<script>setTimeout(function() { window.location.href = "list_projet.php"; }, 5000);</script>';
        } else {
            echo "Erreur lors de la mise à jour de la tâche : " . mysqli_error($dbhandle);
        }
    }
}


// Requête SQL pour récupérer les enregistrements de la table "taches"
$sql = "SELECT * FROM taches";
$result = mysqli_query($dbhandle, $sql);
?>

<!-- Code HTML pour la liste des projets -->
<h1>Liste des projets</h1>
<table class='table table-bordered'>
    <tr><th>Titre</th><th>Description</th><th>Date de début</th><th>Date de fin</th><th>Actions</th></tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['titre'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['date_debut'] . "</td>";
        echo "<td>" . $row['date_fin'] . "</td>";
        echo "<td>";
        echo "<a href='?delete_id=" . $row['id'] . "' class='btn btn-danger'>Supprimer</a>";
        echo "<a href='javascript:void(0);' class='btn btn-primary edit-button' data-id='" . $row['id'] . "'>Éditer</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>





<!-- Code HTML pour le formulaire d'édition -->
<div class="popup" id="edit-popup">
    <div class="popup-content">
        <h2>Éditer la tâche</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" id="edit-id" value="">
          
            <input type="text" id="titre" name="titre" required >
         
            <input type="email" id="email" name="email" required>
         
            <input type="text" id="description" name="description" required>
          
            <input type="date" id="date_debut" name="date_debut" required>
           
            <input type="date" id="date_fin" name="date_fin" required>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</div>


<?php
// Traitement du formulaire d'édition
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    
    // Requête SQL pour récupérer les données de la tâche en fonction de l'ID
    $sql = "SELECT * FROM taches WHERE id = $edit_id";
    $result = mysqli_query($dbhandle, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $tache = mysqli_fetch_assoc($result);
        $id = $tache['id'];
        $titre = $tache['titre'];
        $email = $tache['email'];
        $description = $tache['description'];
        $date_debut = $tache['date_debut'];
        $date_fin = $tache['date_fin'];
    }
}
?>
<script>
    var editButtons = document.querySelectorAll(".edit-button");
    var editPopup = document.getElementById("edit-popup");
    var editIdField = document.getElementById("edit-id");
    
    editButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var id = button.getAttribute("data-id");
            // Vous devriez utiliser "edit_id" ici pour correspondre à votre code PHP
            editIdField.value = id;
            editPopup.style.display = "block";
        });
    });

    // Fonction pour fermer la fenêtre modale
    function fermerPopup() {
        editPopup.style.display = "none";
    }
</script>





                
               
             
              

               
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->

    <div class="overlay"></div>

    <!-- SCRIPT -->
    <!-- APEX CHART -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- APP JS -->
    <script src="./js/app.js"></script>




</body>

</html>