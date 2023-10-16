<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon panier</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <nav>
            <h1>Amazoff</h1>
            <ul>
                <li><button><a href="index.php">Accueil</a></button></li>
                <li><button><a href="panier.php">Mon panier</a></button></li>
            </ul>
        </nav>
    </header>
</body>
</html>
<?php 
// Vérifier si le cookie de panier existe déjà
if (!isset($_COOKIE['panier'])) {
    // Si le cookie de panier n'existe pas, initialiser un tableau vide
    $panier = array();
  } else {
    // Si le cookie de panier existe, récupérer le tableau de panier à partir du cookie
    $panier = unserialize($_COOKIE['panier']);
  }
  
  // Vérifier si un produit a été ajouté au panier (en vérifiant si l'ID du produit a été passé en paramètre GET)
  if (isset($_GET['nom'])) {
    // Ajouter le produit au tableau de panier
    $panier[$_GET['nom']] ++;
    // Enregistrer le tableau de panier dans le cookie
    setcookie('panier', serialize($panier), time() + 60 * 60 * 24 * 14); // 2 semaines
}
//récupérer les données envoyés 
if(isset($_GET['nom'])){
    $nom_produit = $_GET['nom'];
    echo ('Vous avez ajouté le produit ' . $nom_produit);
}

//faire le total du panier
$total = 0;

foreach ($panier as $produit => $quantite) {
    $prix_produit = 0;
    switch($produit){
        case 'Produit-A':
            $prix_produit = 9;
            break;
        case 'Produit-B':
            $prix_produit = 19;
            break;
        case 'Produit-C':
            $prix_produit = 79;
            break;
        case 'Produit-D':
            $prix_produit = 5;
            break;
        case 'Produit-E':
            $prix_produit = 45;
            break;
        case 'Produit-F':
            $prix_produit = 29;
            break;
        case 'Produit-G':
            $prix_produit = 10;
            break;
    }
    $total += $quantite * $prix_produit;
}
echo "<p>Le total des produits dans votre panier est de : "  . $total . " euros.</p>" ;
// // Afficher le contenu du panier (pour le débogage)
//   echo '<pre>';
//   print_r($panier);
//   echo '</pre>';
?>
