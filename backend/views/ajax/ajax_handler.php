<?php
// Include your database connection code here
$pdo = new PDO('mysql:host=localhost;dbname=textiles', 'root', ' ');

$selectedCity = $_GET['city'];
$selectedIntervention = $_GET['intervention'];

$query = "SELECT history.year_of_intervention, history.giz_intervention, history.focal_person, history.comments,
                 intervention.name_of_intervention, intervention.short_description, intervention.giz_module, intervention.component_manager, intervention.comments
          FROM giz_interventions_history history
          INNER JOIN stakeholder ON history.stakeholder_id = stakeholder.stakeholder_id
          INNER JOIN giz_intervention intervention ON history.intervention_id = intervention.intervention_id
          WHERE stakeholder.organizational_location = :city AND intervention.name_of_intervention = :intervention";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':city', $selectedCity);
$stmt->bindParam(':intervention', $selectedIntervention);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$responseData = [
    'history' => [],
    'interventions' => []
];
foreach ($data as $row) {
    $responseData['history'][] = [
        'year_of_intervention' => $row['year_of_intervention'],
        'giz_intervention' => $row['giz_intervention'],
        'focal_person' => $row['focal_person'],
        'comments' => $row['comments']
    ];
    $responseData['interventions'][] = [
        'name_of_intervention' => $row['name_of_intervention'],
        'short_description' => $row['short_description'],
        'giz_module' => $row['giz_module'],
        'component_manager' => $row['component_manager'],
        'comments' => $row['comments']
    ];
}

header('Content-Type: application/json');
echo json_encode($responseData);
?>
