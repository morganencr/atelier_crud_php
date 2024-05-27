<?php
//on démarre une session
session_start();

if(
    isset($_POST["first_name"]) && !empty($_POST["first_name"])
    && isset($_POST["last_name"]) && !empty($_POST["last_name"])
){
require_once("connect.php");

$first_name = strip_tags($_POST["first_name"]);
$last_name = strip_tags($_POST["last_name"]);

$sql = "INSERT INTO users (first_name, last_name)
        VALUES (:first_name, :last_name)";

$query = $db->prepare($sql);
$query->bindValue(":first_name", $first_name);
$query->bindValue(":last_name", $last_name);

$query->execute();

$_SESSION["message"] = "Utilisateur.ice ajouté.e";
header("Location: index.php");
} else {
    echo "Veuillez remplir le formulaire svp!!!!!!";
}