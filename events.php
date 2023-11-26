<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion des taches</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>

   


<style>
:root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #8DB8CA !important;
            border-style: solid;
            border-width: 1px !important;
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
                <a href="add_project.php" class="sidebar-menu-dropdown">
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
                <a href="#">
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
              Events/Callender
            </div>
            
        </div>
        <div class="main-content ">
            
          

            
            <div class="row">

           
            <div class="container py-5" id="page-container">
        <div class="row">
        <div class="col-md-9">
    <div id="calendar" style="max-height: 600px; overflow-y: auto;"></div>
</div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Formulaire d'événement</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_event.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Titre</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Commencer</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">Fin</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Sauvegarder</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Détails du calendrier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Titre</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Commencer</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Fin</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                <div class="text-end">
                    <button type="button" class="btn btn-primary btn-sm rounded-0 edit-button" data-id="">Modifier</button>
                    <button type="button" class="btn btn-danger btn-sm rounded-0 delete-button" data-id="">Supprimer</button>
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Fermer</button>
                </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->



   


    <script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'events_data.php',
        eventClick: function(info) {
            var id = info.event.id;
            var _details = $('#event-details-modal');
            var eventData = calendar.getEventById(id);

            if (eventData) {
                _details.find('#title').text(eventData.title);
                _details.find('#description').text(eventData.extendedProps.description);
                _details.find('#start').text(eventData.start.toLocaleString());
                _details.find('#end').text(eventData.end.toLocaleString());

                // Set the data-id attribute for the edit and delete buttons
                _details.find('.edit-button').attr('data-id', id);
                _details.find('.delete-button').attr('data-id', id);

                _details.modal('show');
            } else {
                alert("L'événement n'est pas défini");
            }
        },
        editable: true,
    });

    calendar.render();
});

// Edit Button
$('.edit-button').click(function() {
    var id = $(this).data('id');
    if (!!scheds[id]) {
        var _form = $('#schedule-form');
        _form.find('[name="id"]').val(id);
        _form.find('[name="title"]').val(scheds[id].title);
        _form.find('[name="description"]').val(scheds[id].description);
        _form.find('[name="start_datetime"]').val(scheds[id].start_datetime);
        _form.find('[name="end_datetime"]').val(scheds[id].end_datetime);
        $('#event-details-modal').modal('hide');
        _form.find('[name="title"]').focus();
    } else {
        alert("L'événement n'est pas défini");
    }
});

// Delete Button
   // Delete Button / Deleting an Event
   $('.delete-button').click(function() {
    var id = $(this).attr('data-id');
    if (!!scheds[id]) {
        var _conf = confirm("Êtes-vous sûr de supprimer cet événement programmé?");
        if (_conf === true) {
            location.href = "./delete_event.php?id=" + id;
        }
    } else {
        alert("L'événement n'est pas défini");
    }
});

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- APP JS -->
   
    
    <?php
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "mon_pfa";

// Établir une connexion à la base de données
$conn = new mysqli($hostname, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

$schedules = $conn->query("SELECT * FROM `schedule_list`");
$sched_res = [];
foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
    $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
echo '<script>var scheds = ' . json_encode($sched_res) . ';</script>';
// Fermer la connexion à la base de données
$conn->close();
?>


</body>


</html>
