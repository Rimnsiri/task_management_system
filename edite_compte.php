



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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <style>/* Style de l'input */
#tacheInput1 {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
#tacheInput2 {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
#tacheInput3 {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}


/* Style de l'icône de suppression */


/* Au survol de l'icône de suppression (optionnel) */
li span:hover {
    text-decoration: underline; /* Souligner l'icône au survol */
}
</style>
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
            Modifier Compte
        </div>
    </div>
    <div class="main-content">
        <div class="row">
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur :</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
            </div>
            <div class="mb-3">
                <label for="motdepasse" class="form-label">Nouveau mot de passe :</label>
                <input type="password" name="motdepasse" id="motdepasse" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>

            <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $username = $_POST['username'];
        $nouveauMotDePasse = $_POST['motdepasse'];
    
        // Effectuer la mise à jour des données dans la base de données
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id']; // Vous devez avoir l'ID de l'utilisateur connecté
    
            // Connexion à la base de données (à personnaliser)
            $db_username = "root";
            $db_password = "";
            $db_hostname = "localhost";
            $db_dbname = "mon_pfa";
    
            $dbhandle = mysqli_connect($db_hostname, $db_username, $db_password, $db_dbname);
    
            // Vérifier la connexion
            if (!$dbhandle) {
                die("La connexion à la base de données a échoué : " . mysqli_connect_error());
            }
    
            // Mettre à jour les données du compte
            $update_sql = "UPDATE user SET username = '$username'";
    
            // Mettre à jour le mot de passe s'il a été fourni
            if (!empty($nouveauMotDePasse)) {
                $hashedMotDePasse = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
                $update_sql .= ", password = '$hashedMotDePasse'";
            }
    
            $update_sql .= " WHERE id = $id";
    
            if (mysqli_query($dbhandle, $update_sql)) {
                echo "Les données du compte ont été mises à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des données du compte : " . mysqli_error($dbhandle);
            }
    
            mysqli_close($dbhandle);
        } else {
            echo "ID d'utilisateur non défini dans la session. Assurez-vous que l'utilisateur est correctement authentifié.";
        }
    }
    
    
        ?>
        </div>
    </div>
</div>




                       
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX2+Pt6V2DJa/R1SP+9VXt2+RqMk1D" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMp9Mvc9CnWXmDQQeG4Z98k/0jCp4QXp42qg5xD4G2u" crossorigin="anonymous"></script>  
              
 
               
                  
     



      
    <!-- END MAIN CONTENT -->

    <div class="overlay"></div>

    <!-- SCRIPT -->
    <!-- APEX CHART -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- APP JS -->
    <script src="./js/app.js"></script>
 
  


</body>

</html>