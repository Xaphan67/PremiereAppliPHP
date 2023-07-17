<?php
session_start(); // Démarre une session PHP

if (isset($_GET['action'])) { // Vérifié que action n'est pas null
    switch ($_GET['action']) {

        case "add": // Si l'action est 'add'...
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

        case "delete-id":
            if (isset($_POST['submit'])) {
                unset($_SESSION['products'][$_GET['id']]);
            }
    }
}

//header("Location:index.php"); // Redirection vers index.php