<!DOCTYPE html>
<html>
<head>
    <title>Enregistrement d'un objectif</title>
</head>
<body>

<a href="index.html">Accueil</a>

<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "db_onegoal";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
} else {
    echo "Connexion réussie 😀<br>";
}

// Récupérer les données en les échappant
$titre = mysqli_real_escape_string($connexion, $_GET['titreObj']);
$date_deb = mysqli_real_escape_string($connexion, $_GET['dateObjDeb']);
$date_fin = mysqli_real_escape_string($connexion, $_GET['dateObjFin']);

// Requête préparée
$req = $connexion->prepare("INSERT INTO objectif (nom_objectif, date_deb_obj, date_fin_obj) VALUES (?, ?, ?)");
$req->bind_param("sss", $titre, $date_deb, $date_fin);

if ($req->execute()) {
    echo "Enregistrement réussi.";
} else {
    echo "Erreur d'enregistrement : " . $req->error;
}

// Fermer la connexion
$connexion->close();
?>

</body>
</html>
