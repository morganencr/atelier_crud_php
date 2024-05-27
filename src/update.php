<?php

if($_POST){
    if(isset($_POST["id"]) && !empty($_POST["id"])
      && isset($_POST["first_name"]) && !empty($_POST["first_name"])
    && isset($_POST["last_name"]) && !empty($_POST["last_name"])
    ){
        require_once("connect.php");

        $id = strip_tags($_POST["id"]);
        $first_name = strip_tags($_POST["first_name"]);
        $last_name = strip_tags($_POST["last_name"]);
        
        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindValue(":id", $id);
        $query->bindValue(":first_name", $first_name);
        $query->bindValue(":last_name", $last_name);

        $query->execute();
        header("Location: index.php");
        
    }else {
        echo "Remplissez le formulaire";
    }
}
if(isset($_GET["id"]) && !empty($_GET["id"])){



    require_once("connect.php");
    
    //on affiche pas le nombre de l'id car sinon il y a un conflit au niveau de la redirection car il doit afficher plusieurs choses
    // echo $_GET["id"];
    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM users WHERE id = :id";
    $query = $db->prepare($sql);
    //on accroche la valeur id de la requête à celle de la variable $id
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    
    $query->execute();
    
    $user = $query->fetch();
    
    //!$user = le ! c'est pour vérifier si l'utilisateur existe,le ! = c'est vide
    if(!$user){
        header("Location: index.php");
    }else{
        require_once("disconnect.php");
    }
    
    // print_r($user);
    }else{
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
</head>
<body>
    <h1>Modifier <?= $user["first_name"] . " " . $user["last_name"] ?></h1>
    <form method="post">
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="<?= $user["first_name"]?>" required>
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="<?= $user["last_name"]?>" required>
        <input type="hidden" name="id" value="<?= $user["id"]?>" required>
        <button>Modifier</button>
    </form>
    <a href="index.php">Retour</a>
    <!-- <?php print_r($_POST);?> -->

</body>
</html>