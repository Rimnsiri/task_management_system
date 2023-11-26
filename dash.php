




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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    
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
                <a href="#" class="active">
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
                        <a href="add_project.php" >
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
                tableau de bord
            </div>
            
        </div>
        <div class="main-content">
            <div class="row">
                
            


                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                                Tâches ouvertes
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                    3
                                </div>
                                <i class='bx bx-task-x' ></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                            total de l'événement
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                <?php
// Connexion à la base de données
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa";

// Créez la connexion
$dbhandle = mysqli_connect($hostname, $username, $password, $dbname);

// Vérifiez la connexion
if (!$dbhandle) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Requête SQL pour compter les éléments dans une table (par exemple, 'ma_table')
$sql = "SELECT COUNT(*) as total FROM schedule_list";

$result = mysqli_query($dbhandle, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];

    echo $total; // Afficher le nombre d'éléments
} else {
    echo "Erreur lors de la requête : " . mysqli_error($dbhandle);
}

// Fermer la connexion
mysqli_close($dbhandle);
?>
                                </div>
                                <i class='bx bx-task'></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                                Projets totaux
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                <?php
// Connexion à la base de données
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa";

// Créez la connexion
$dbhandle = mysqli_connect($hostname, $username, $password, $dbname);

// Vérifiez la connexion
if (!$dbhandle) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Requête SQL pour compter les éléments dans une table (par exemple, 'ma_table')
$sql = "SELECT COUNT(*) as total FROM taches";

$result = mysqli_query($dbhandle, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];

    echo $total; // Afficher le nombre d'éléments
} else {
    echo "Erreur lors de la requête : " . mysqli_error($dbhandle);
}

// Fermer la connexion
mysqli_close($dbhandle);
?>


                                </div>
                                <i class='bx bx-line-chart'></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="box box-hover">
                        <!-- COUNTER -->
                        <div class="counter">
                            <div class="counter-title">
                                Profil total
                            </div>
                            <div class="counter-info">
                                <div class="counter-count">
                                <?php
// Connexion à la base de données
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa";

// Créez la connexion
$dbhandle = mysqli_connect($hostname, $username, $password, $dbname);

// Vérifiez la connexion
if (!$dbhandle) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Requête SQL pour compter les éléments dans une table (par exemple, 'ma_table')
$sql = "SELECT COUNT(*) as total FROM user";

$result = mysqli_query($dbhandle, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];

    echo $total; // Afficher le nombre d'éléments
} else {
    echo "Erreur lors de la requête : " . mysqli_error($dbhandle);
}

// Fermer la connexion
mysqli_close($dbhandle);
?>
                                </div>
                                <i class='bx bx-user'></i>
                            </div>
                        </div>
                        <!-- END COUNTER -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3 col-md-6 col-sm-12">
                    <!-- TOP PRODUCT -->
                    <div class="box f-height">
                        <div class="box-header">
                            backlog
                        </div>
                           <input type="text" id="tacheInput1" placeholder="ajouter">
        <ul id="listeTaches1"></ul>
                        
                       
                    </div>
                   
                      
                    <!-- TOP PRODUCT -->
                </div>
                <div class="col-4 col-md-6 col-sm-12">
                    <!-- CATEGORY CHART -->
                    <div class="box f-height">
                        <div class="box-header">
                             Taches En cours
                        </div>
                        <input type="text" id="tacheInput2" placeholder="ajouter">
        <ul id="listeTaches2"></ul>
        
                    </div>
                    
                    <!-- END CATEGORY CHART -->
                </div>
 
               
                  
                  <div class="col-5 col-md-12 col-sm-12">
    <!-- CUSTOMERS CHART -->
    <div class="box f-height">
        <div class="box-header">
            Tâches Faites
        </div>
        <input type="text" id="tacheInput3" placeholder="ajouter">
        <ul id="listeTaches3"></ul>
    </div>
    <!-- END CUSTOMERS CHART -->
</div>



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
 
    <script>
// Fonction pour ajouter une tâche à la liste
function ajouterTache(inputId, listeId) {
 // Récupérer les  éléments HTML
    const input = document.getElementById(inputId);
    const liste = document.getElementById(listeId);

    // Récupérer les tâches précédemment stockées dans le stockage local
    const taches = JSON.parse(localStorage.getItem(listeId)) || [];

    // Ajouter les tâches stockées à la liste
    for (const tacheText of taches) {
        ajouterElementListe(liste, tacheText);
    }
    // Ajouter un écouteur d'événements pour détecter l'appui sur la touche "Enter"

    input.addEventListener("keyup", function (event) {
        if (event.key === "Enter" && input.value.trim() !== "") {
            // Ajouter la nouvelle tâche à la liste
            const tacheText = input.value.trim();
            ajouterElementListe(liste, tacheText);

            // Ajouter la nouvelle tâche au tableau des tâches et le stocker dans le stockage local
            taches.push(tacheText);
            localStorage.setItem(listeId, JSON.stringify(taches));

            // Effacer le champ d'entrée
            input.value = ""; 
        }
    });
}

// Fonction pour ajouter un élément à la liste avec une icône de suppression et un bouton de modification
function ajouterElementListe(liste, texte) {
    // Créer les éléments HTML nécessaires
    const nouvelElement = document.createElement("li");
    const texteElement = document.createElement("span");
    texteElement.textContent = texte;
    
    const supprimerElement = document.createElement("button");
    supprimerElement.textContent = "❌";
    supprimerElement.addEventListener("click", function () {
        // Supprimer l'élément de la liste
        liste.removeChild(nouvelElement);

        // Retirer la tâche correspondante du stockage local
        const taches = JSON.parse(localStorage.getItem(liste.id)) || [];//trécupiri données ili metab9a maa clé spécifiée liste_id a partir stockage locale b ete3mel localStorage.getItem() 
        const index = taches.indexOf(texte);//ncherchi a3ala indice b indexOf
        if (index !== -1) {
            taches.splice(index, 1);
            localStorage.setItem(liste.id, JSON.stringify(taches));
        }
    });

    const modifierElement = document.createElement("button");
    modifierElement.textContent = "✎";
    modifierElement.addEventListener("click", function () {
        // Demander à l'utilisateur de modifier la tâche
        const nouvelleTacheText = prompt("Modifier la tâche", texteElement.textContent);
        if (nouvelleTacheText !== null) {
            // Mettre à jour le texte de la tâche dans l'interface utilisateur
            texteElement.textContent = nouvelleTacheText;
            // Mettre à jour la tâche correspondante dans le stockage local
            const taches = JSON.parse(localStorage.getItem(liste.id)) || [];
            const index = taches.indexOf(texte);
            if (index !== -1) { //nvérifi indice mta3 taches dans la liste est diff a -1
                taches[index] = nouvelleTacheText;//mise a jours texte da la tache a l'indice spécifie avec le nv text 
                localStorage.setItem(liste.id, JSON.stringify(taches)); //mise a jour mta3 stockage local w JSON.stringify tconvertie  une chaine json en tableau js  3la5ater stockage ma yestokych des chaine de text
            }
        }
    });
 // Ajouter les éléments à l'élément de liste
    nouvelElement.appendChild(texteElement);
    nouvelElement.appendChild(supprimerElement);
    nouvelElement.appendChild(modifierElement);
    // Ajouter l'élément de liste à la liste principale
    //appendChild méthode JavaScript utilisée pour ajouter un nœud
    liste.appendChild(nouvelElement);
}

// Appeler la fonction pour chaque paire de champ d'entrée et de liste
ajouterTache("tacheInput1", "listeTaches1");
ajouterTache("tacheInput2", "listeTaches2");
ajouterTache("tacheInput3", "listeTaches3");

</script>

</body>

</html>