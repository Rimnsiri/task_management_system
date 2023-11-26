



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
       gestion taches
    </title>
   <link rel="icon" href="img1.png" type="image/x-icon"> 
    <link rel="shortcut icon" href="/images/logo-mb.png" type="image/png">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- APP CSS -->
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/app.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                    <span>tableau de bord</span>
                </a>
            </li>
        
           
            <li class="sidebar-submenu">
                <a href="#" class="sidebar-menu-dropdown">
                    <i class='bx bx-user-circle'></i>
                    <span>compte</span>
                    <div class="dropdown-icon"></div>
                </a>
                <ul class="sidebar-menu sidebar-menu-dropdown-content">
                    <li>
                        <a href="edite_compte.php">
                        Editer le profil
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        paramètres du compte
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
                        <a href="add_project.php" id="popup-link">
                            Ajouter projet
                        </a>
                    </li>
                    <li>
                        <a href="list_projet.php" id="popup-link">
                            list projet 
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
                    <span>calendrier</span>
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
                Ajouter projet
            </div>
            
        </div>
        <div class="main-content">
            <div class="row">


            <div class="container">
        <form id="popup-form" method="POST" action="" class="mx-auto">
            <div class="form-row">
                <div class="form-group col-md-6 mb-3">
                    <input type="text" class="form-control" id="titre" name="titre" required placeholder="Titre" required>
                </div>
                <div class="col-md-6 mb-3 my-1">
                   
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group col-md-6 mb-3">
                <label for="" class="control-label">Date_debut</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut"  required>
                </div>

                <div class="form-group col-md-6 mb-3">
                <label for="" class="control-label">Date_fin</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin"  required>
                </div>
                <div class="col-md-10">
				<div class="form-group">
					<label for="" class="control-label">Description</label>
					<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
						
					</textarea>
				</div>
			</div>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-secondary">ajouter</button>
        </form>

        <?php
error_reporting(E_ALL);

// Connexion à la base de données
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "mon_pfa"; // Remplacez par le nom de votre base de données

// Activer le signalement des erreurs
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connexion à la base de données
$dbhandle = mysqli_connect($hostname, $username, $password, $dbname);

if (!$dbhandle) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérifier si le formulaire est soumis
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    // Si les champs ne sont pas vides, insérer les données dans la base
    if (!empty($titre) && !empty($email) && !empty($description) && !empty($date_debut) && !empty($date_fin)) {
        // Échapper les données pour éviter les injections SQL
        $titre = mysqli_real_escape_string($dbhandle, $titre);
        $email = mysqli_real_escape_string($dbhandle, $email);
        $description = mysqli_real_escape_string($dbhandle, $description);
        $date_debut = mysqli_real_escape_string($dbhandle, $date_debut);
        $date_fin = mysqli_real_escape_string($dbhandle, $date_fin);

        // Définition de la requête + exécution de la requête
        $sql = "INSERT INTO taches (titre, email, description, date_debut, date_fin) VALUES ('$titre', '$email', '$description', '$date_debut', '$date_fin');";

        $result = mysqli_query($dbhandle, $sql);

        if ($result) {
            echo '<div id="success-message" class="alert alert-success">Enregistrement projet réussi.</div>';
        }
    } 
}

// Fermer la connexion
mysqli_close($dbhandle);
?>




             </div>
        </div>




    </div>
    </div>
                
       


           




                               

                                
    <script>
        
        // JavaScript pour cacher le message de succès après 5 secondes
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000); // 5000 millisecondes (5 secondes)

    </script>         
                   
 
               
                  
                
   


    <!-- SCRIPT -->
    <!-- APEX CHART -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- APP JS -->
    <script src="./js/app.js"></script>
 

</body>

</html>