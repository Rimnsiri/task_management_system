<?php
// Inclure la configuration de connexion à la base de données
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "mon_pfa";

$conn = new mysqli($hostname, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Exécuter une requête pour obtenir les données des événements
$query = "SELECT id, title, start_datetime, end_datetime, description FROM schedule_list";
$result = $conn->query($query);

if ($result) {
    $events = array();

    while ($row = $result->fetch_assoc()) {
        // Convertir les dates au format ISO 8601 pour le calendrier FullCalendar
        $start_datetime = date('c', strtotime($row['start_datetime']));
        $end_datetime = date('c', strtotime($row['end_datetime']));

        $event = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $start_datetime,
            'end' => $end_datetime,
            'description' => $row['description']
        );

        $events[] = $event;
    }

    // Convertir le tableau en format JSON
    $json = json_encode($events);

    // Définir l'en-tête Content-Type
    header('Content-Type: application/json');

    // Envoyer la réponse JSON
    echo $json;
} else {
    echo json_encode(array('error' => 'Erreur de requête.'));
}

// Fermer la connexion à la base de données
$conn->close();
?>
