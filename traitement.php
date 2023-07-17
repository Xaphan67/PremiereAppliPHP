<?php
session_start(); // Démarre une session PHP

if (isset($_GET['action'])) { // Vérifié que action n'est pas null
    switch ($_GET['action']) {

        case "add": // Si l'action est 'add' (Ajout d'un produit)

            if (isset($_POST['submit'])) // Vérifie que cette page à été accédée via l'envoi d'un formulaire
            {
                // Nétoie les données envoyées par le formulaire par sécurité
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                if ($name && $price && $qtt) // Vérifie que les variables ne sont pas égales a null ou false
                {
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt
                    ];

                    $_SESSION['products'][] = $product;
                }
            }
            break;


        case "delete-id": // Si l'action est 'delete-id' (Suppression d'un produit spécifique)
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) // Vérifie que l'id du produit existe dans l'url, et que le produit existe
            {
                unset($_SESSION['products'][$_GET['id']]);
            }
            header("Location:recap.php");
            exit();
            break;

        case "delete": // Si l'action est 'delete' (Supression de tous les produits)
            if (isset($_SESSION['products'])) // Vérifie que les produits existent en session
            {
                unset($_SESSION['products']);
            }
            header("Location:recap.php");
            exit();
            break;

        case "qttUp": // Si l'action est 'qttUp" (Augmenter la quantité)
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) // Vérifie que l'id du produit existe dans l'url, et que le produit existe
            {
                $_SESSION['products'][$_GET['id']]["qtt"]++;
            }
            header("Location:recap.php");
            exit();
            break;

        case "qttDown": // Si l'action est 'qttDown" (Réduitr la quantité)
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) // Vérifie que l'id du produit existe dans l'url, et que le produit existe
            {
                if ($_SESSION['products'][$_GET['id']]["qtt"] > 1) // Vérifie qu'il y ai au moins un produit restant après la suppression
                {
                    $_SESSION['products'][$_GET['id']]["qtt"]--;
                }
            }
            header("Location:recap.php");
            exit();
            break;
    }
}

header("Location:index.php"); // Redirection vers index.php