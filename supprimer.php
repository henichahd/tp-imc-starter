<?php
require_once 'connexion.php';

// Ex 7 : Vérifier que $_GET['id'] existe et est un entier valide
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id !== false && $id !== null && $id > 0) {
    // Ex 7 & 8 : Requête préparée
    $stmt = $pdo->prepare("DELETE FROM mesures WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

// Ex 7 : Rediriger vers index.php
header('Location: index.php');
exit;
