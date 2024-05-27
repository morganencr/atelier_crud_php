<?php

//On vérifie que l'id existe bien dans l'url et que l'utilisateur correspondant existe

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
    } else {
        //On gère la suppression de l'utilisateur
        $sql = "DELETE FROM users WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
    
        $query->execute();
        header("Location: index.php");
    }



    // print_r($user);
    }else{
        header("Location: index.php");
    }
    ?>