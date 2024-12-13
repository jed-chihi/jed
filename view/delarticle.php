<?php
include '../Controller/articlesController.php';
$ProductC = new articleController();

// récupérer l'id passé dans l'URL en utilisant la methode par défaut $_GET["id"]
$ProductC->deleteArticle($_GET["id"]);
//une fois la suppression est faite une redirection vers la liste des produits ce fait
header('Location:articleForm.php');

?>