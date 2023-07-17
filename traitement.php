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

                // Stocke les information du fichier envoyé
                $file = "";
                if (isset($_FILES['file']) && !$error) {
                    $tmpName = $_FILES['file']['tmp_name'];
                    $filename = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];

                    $tabExtension = explode('.', $filename); // Sépare le nom du fichier et son extension
                    $extension = strtolower(end($tabExtension)); // Stock l'extension

                    //Tableau des extensions acceptées
                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];

                    // Taille maximale acceptée (en bytes)
                    $maxSize = 400000;

                    // Vérifie que l'extension et la taille sont accepté
                    if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                        $uniqueName = uniqid('', true);
                        $file = $uniqueName . "." . $extension;
                        move_uploaded_file($tmpName, './upload/' . $file); // Upload le fichier dans le dossier upload
                    } else { // Génère un message d'erreur en fonction de l'erreur rencontrée
                        if (!in_array($extension, $extensions)) {
                            $_SESSION['message'][0] = "productExtError";
                        } else if ($size >= $maxSiz) {
                            $_SESSION['message'][0] = "productSizeError";
                        } else if ($error != 0) {
                            $_SESSION['message'][0] = "productFileError";
                        }
                        header("Location:index.php");
                        exit();
                    }
                }

                if ($name && $price && $qtt && $file) // Vérifie que les variables ne sont pas égales a null ou false
                {
                    $product = [ // Crée un produit avec les informations
                        "name" => $name,
                        "file" => $file,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt
                    ];

                    $_SESSION['products'][] = $product;
                    $_SESSION['message'][0] = "productAdded";
                } else {
                    $_SESSION['message'][0] = "productError";
                }
            }
            break;


        case "delete-id": // Si l'action est 'delete-id' (Suppression d'un produit spécifique)
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) // Vérifie que l'id du produit existe dans l'url, et que le produit existe
            {
                $_SESSION['message'][0] = "productDeleted";
                unlink("./upload/" . $_SESSION['products'][$_GET['id']]['file']); // Supprime l'image correspondant au produit
                unset($_SESSION['products'][$_GET['id']]); // Supprime les informations du produit de la session
            }
            header("Location:recap.php");
            exit();
            break;

        case "delete": // Si l'action est 'delete' (Supression de tous les produits)
            if (isset($_SESSION['products'])) // Vérifie que les produits existent en session
            {
                foreach ($_SESSION['products'] as $product) {
                    unlink("./upload/" . $product['file']);
                }
                unset($_SESSION['products']);
            }
            header("Location:recap.php");
            exit();
            break;

        case "qttUp": // Si l'action est 'qttUp" (Augmenter la quantité)
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) // Vérifie que l'id du produit existe dans l'url, et que le produit existe
            {
                $_SESSION['products'][$_GET['id']]["qtt"]++;
                $_SESSION['products'][$_GET['id']]["total"] += $_SESSION['products'][$_GET['id']]["price"];
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
                    $_SESSION['products'][$_GET['id']]["total"] -= $_SESSION['products'][$_GET['id']]["price"];
                }
            }
            header("Location:recap.php");
            exit();
            break;
    }
}

header("Location:index.php"); // Redirection vers index.php