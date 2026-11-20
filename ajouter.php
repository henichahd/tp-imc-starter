<?php
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ex 7 : Récupérer personne_id, poids et taille depuis $_POST
    $personne_id = filter_input(INPUT_POST, 'personne_id', FILTER_VALIDATE_INT);
    $poids       = filter_input(INPUT_POST, 'poids', FILTER_VALIDATE_FLOAT);
    $taille      = filter_input(INPUT_POST, 'taille', FILTER_VALIDATE_FLOAT);

    // Ex 8 : Validation côté serveur (champs présents et bornes respectées)
    $valide = $personne_id !== false && $personne_id !== null && $personne_id > 0
           && $poids !== false && $poids !== null && $poids >= 20 && $poids <= 300
           && $taille !== false && $taille !== null && $taille >= 0.5 && $taille <= 2.5;

    if ($valide) {
        // Ex 7 : Calculer l'IMC et déterminer la catégorie
        $imc = round($poids / ($taille * $taille), 1);

        if ($imc < 18.5) {
            $categorie = 'Sous-poids';
        } elseif ($imc < 25) {
            $categorie = 'Normal';
        } elseif ($imc < 30) {
            $categorie = 'Surpoids';
        } else {
            $categorie = 'Obésité';
        }

        // Ex 7 & 8 : Requête préparée (protection contre l'injection SQL)
        $stmt = $pdo->prepare(
            "INSERT INTO mesures (personne_id, poids, taille, imc, categorie)
             VALUES (:personne_id, :poids, :taille, :imc, :categorie)"
        );
        $stmt->execute([
            ':personne_id' => $personne_id,
            ':poids'       => $poids,
            ':taille'      => $taille,
            ':imc'         => $imc,
            ':categorie'   => $categorie,
        ]);
    }
}

// Ex 7 : Rediriger vers index.php
header('Location: index.php');
exit;
