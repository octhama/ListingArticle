<?php
require 'connect.php'; // Assurez-vous d'avoir le fichier de connexion (connect.php)

$bdd = new connect(); // Création d'un objet de connexion à la base de données
$bdd->connect(); // Connexion à la base de données sandboxnews

// Fonction pour obtenir toutes les données de la table sandboxnews
function getAllData() {
    global $bdd;
    $result = $bdd->conn->query("SELECT * FROM sandboxnews");
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour obtenir les données d'une news spécifique par son ID
function getDataById($id) {
    global $bdd;
    $stmt = $bdd->conn->prepare("SELECT * FROM sandboxnews WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Utilisation de bindParam pour éviter les injections SQL
    $stmt->execute(); // Exécution de la requête préparée ci-dessus avec l'ID en paramètre
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne le résultat de la requête préparée
}

// Affichage des messages d'erreur ou de succès
$message = '';

// Traitement pour la suppression
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM sandboxnews WHERE id = :id";
    $stmt = $bdd->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Utilisation de bindParam pour éviter les injections SQL
    if ($stmt->execute()) {
        $message = 'News supprimée avec succès.';
    } else {
        $message = 'Erreur lors de la suppression de la news.';
    }
}

// Traitement pour la modification
if (isset($_POST['modifier'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $alias = isset($_POST['alias']) ? $_POST['alias'] : '';
    $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';
    $dateajout = !empty($_POST['dateajout']) ? $_POST['dateajout'] : date('Y-m-d');
    $datemaj = isset($_POST['datemaj']) ? $_POST['datemaj'] : date('Y-m-d');

    // Modification des données du formulaire dans la base de données sandboxnews
    $sql = "UPDATE sandboxnews SET Titre=:titre, Alias=:alias, Contenu=:contenu, Dateajout=:dateajout, Datemaj=:datemaj WHERE id=:id";
    $stmt = $bdd->conn->prepare($sql);
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
    $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
    $stmt->bindParam(':dateajout', $dateajout, PDO::PARAM_STR);
    $stmt->bindParam(':datemaj', $datemaj, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $message = 'News modifiée avec succès.';
    } else {
        $message = 'Erreur lors de la modification de la news.';
    }
}


// Récupération de toutes les données
$data = getAllData();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des News</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .message {
            text-align: center;
            font-weight: bold;
            color: green;
        }

        form {
            display: inline-block;
        }
    </style>
</head>
<body>
<h1>Liste des News</h1>
<div class="message"><?= $message ?></div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Alias</th>
        <th>Contenu</th>
        <th>Date d'ajout</th>
        <th>Date de mise à jour</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['Titre'] ?></td>
            <td><?= $row['Alias'] ?></td>
            <td><?= $row['Contenu'] ?></td>
            <td><?= $row['Dateajout'] ?></td>
            <td><?= $row['Datemaj'] ?></td>
            <td>
                <form action="modifsupp.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="submit" name="modifier" value="Modifier">
                </form>
                |
                <a href="?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette news ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
// Affichage du formulaire de modification si une news est sélectionnée
if (isset($_POST['modifier']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $dataById = getDataById($id);
    ?>
    <h2>Modifier la News</h2>
    <form action="modifsupp.php" method="post">
        <input type="hidden" name="id" value="<?= $dataById['id'] ?>">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="<?= $dataById['Titre'] ?>" required>
        <label for="alias">Alias</label>
        <input type="text" name="alias" id="alias" value="<?= $dataById['Alias'] ?>" required>
        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu" cols="30" rows="10" required><?= $dataById['Contenu'] ?></textarea>
        <label for="dateajout">Date d'ajout</label>
        <input type="date" name="dateajout" id="dateajout" value="<?= $dataById['Dateajout'] ?>" required>
        <label for="datemaj">Date de mise à jour</label>
        <input type="date" name="datemaj" id="datemaj" value="<?= $dataById['Datemaj'] ?>" required>
        <input type="submit" name="modifier" value="Enregistrer">
    </form>
    <a href="index.php">Retour à l'accueil</a>
    <?php
}
?>
</body>
</html>
