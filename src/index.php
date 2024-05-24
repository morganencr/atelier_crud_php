<?php

require_once("connect.php");

$sql = "SELECT * FROM users";

//on prépare la requête
$query = $db->prepare($sql);

//on exécute la requête
$query->execute();
//on récupère les données sous forme de tableau associatif
$users = $query->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($users);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUDité</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table>
        <thead>
            <td>id</td>
            <td>Prénom</td>
            <td>Nom</td>
            <td>ACTIONS</td>
        </thead>
        <tbody>
            <?php
            //pour chaque utilisateur récupéré dans $users, on affiche
            // une nouvelle ligne dans la table html
            foreach($users as $user){
            //chaque utilisateur de la table $users sera identifié 
            //dans le foreach en tant que $user
            ?>
                <tr>
                    <td><?= $user["id"] ?></td>
                    <td><?= $user["first_name"]?></td>
                    <td><?= $user["last_name"] ?></td>
                    <td><a href="user.php?id=<?= $user["id"] ?>">Voir</a>
                </tr>
            <?php
            }
            ?>
            <a href="form.php">Ajoutez un utilisateur</a>

            
        </tbody>
</body>
</html>