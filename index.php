<?php
// Connexion du formulaire a la base de donnees sandboxnews
require 'connect.php'; // Appel du fichier connect.php
$bdd = new connect(); // Creation d'un objet de connexion
$bdd->connect(); // Connexion a la base de donnees
// Creation d'un formulaire de news en utilisant la methode POST
if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $alias = $_POST['alias'];
    $contenu = $_POST['contenu'];
    $dateajout = $_POST['dateajout'];
    $datemaj = $_POST['datemaj'];
    // Insertion des donnees du formulaire dans la base de donnees sandboxnews
    $sql = "INSERT INTO sandboxnews (titre, alias, contenu, dateajout, datemaj) VALUES ('$titre', '$alias', '$contenu', '$dateajout', '$datemaj')";
    $bdd->conn->exec($sql);
    echo 'News ajoutée';
    // Redirection vers la page index.php
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de news</title>
</head>
<style>
    body {
        text-align: center;
    }
    form {
        display: flex;
        flex-direction: column;
        width: 25%;
        margin: auto;
    }
</style>
<body>
<h1>Formulaire de news</h1>
<form action="index.php" method="post">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre">
    <label for="alias">Alias</label>
    <input type="text" name="alias" id="alias">
    <label for="contenu">Contenu</label>
    <textarea name="contenu" id="contenu" cols="30" rows="10"></textarea>
    <label for="dateajout">Date d'ajout</label>
    <input type="date" name="dateajout" id="dateajout">
    <label for="datemaj">Date de mise à jour</label>
    <input type="date" name="datemaj" id="datemaj">
    <input type="submit" name="submit" value="Envoyer">
</form>
<a href="modifsupp.php">Modifier ou supprimer une news</a>
</body>
</html>



