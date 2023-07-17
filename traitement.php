<?php
session_start(); // Démarre une session PHP

if (isset($_GET['action']) && isset($_POST['submit'])) { // Vérifié que action n'est pas null et que cette page à été accédée via l'envoi d'un formulaire
    switch ($_GET['action']) {

        case "add": // Si l'action est 'add' (Ajout d'un produit)
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
            break;


        case "delete-id": // Si l'action est 'delete-id' (Suppression d'un produit spécifique)
            unset($_SESSION['products'][$_GET['id']]);
            break;

        case "delete": // Si l'action est 'delete' (Supression de tous les produits)
            unset($_SESSION['products']);
            break;
    }
}

header("Location:index.php"); // Redirection vers index.php