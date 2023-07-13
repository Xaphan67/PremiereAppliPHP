<?php
    session_start(); // Démarre une session PHP

    if (isset($_POST['submit'])) // Vérifie que cette pas à été accédée via l'envoie d'un formulaire
    {
        // Nétoie les données envoyées par le formulaire par sécurité
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
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


    header("Location:index.php"); // Redirection vers index.php