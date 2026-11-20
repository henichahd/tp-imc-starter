// Calculateur d'IMC — calcul côté navigateur

// Déterminer la catégorie selon les seuils de l'énoncé
function categorieIMC(imc) {
    if (imc < 18.5) return "Sous-poids";
    if (imc < 25) return "Normal";
    if (imc < 30) return "Surpoids";
    return "Obésité";
}

function calculerIMC() {
    const champPoids = document.getElementById("imc-poids");
    const champTaille = document.getElementById("imc-taille");
    const zoneValeur = document.getElementById("imc-valeur");
    const zoneCategorie = document.getElementById("imc-categorie");
    const zoneErreur = document.getElementById("imc-erreur");

    // Effacer l'ancien message d'erreur
    zoneErreur.textContent = "";

    // Lire et convertir en nombres
    const poids = Number(champPoids.value);
    const taille = Number(champTaille.value);

    // Vérifications : vide, non numérique, nul/négatif, hors limites
    let erreur = "";
    if (champPoids.value === "" || champTaille.value === "") {
        erreur = "Veuillez remplir le poids et la taille.";
    } else if (isNaN(poids) || isNaN(taille)) {
        erreur = "Veuillez saisir des nombres valides.";
    } else if (poids <= 0 || taille <= 0) {
        erreur = "Le poids et la taille doivent être positifs.";
    } else if (poids < 20 || poids > 300) {
        erreur = "Le poids doit être compris entre 20 et 300 kg.";
    } else if (taille < 0.5 || taille > 2.5) {
        erreur = "La taille doit être comprise entre 0,5 et 2,5 m (ex : 1.75).";
    }

    if (erreur !== "") {
        zoneErreur.textContent = erreur;
        zoneValeur.textContent = "-";
        zoneCategorie.textContent = "-";
        return; // aucun calcul, pas de NaN
    }

    // Calculer et afficher
    const imc = poids / (taille * taille);
    zoneValeur.textContent = imc.toFixed(1);
    zoneCategorie.textContent = categorieIMC(imc);
}

// Brancher la fonction sur le bouton (sans parenthèses)
document.getElementById("imc-calculer").addEventListener("click", calculerIMC);