<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title><?= $title ?></title>
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Génère une alerte en fonction du message retourné par traitement.php -->
            <?php if (isset($_SESSION['message'])) {
                $type = "info";
                $message = "";
                switch ($_SESSION['message'][0]) {
                    case "productAdded":
                        $type = "success";
                        $message = "Le produit à été ajouté.";
                        break;
                    case "productDeleted":
                        $type = "success";
                        $message = "Le produit à été supprimé.";
                        break;
                    case "productError":
                        $type = "danger";
                        $message = "Certains champs sont vides ou invalides.";
                        break;
                    case "productExtError":
                        $type = "danger";
                        $message = "L'extension du fichier n'est pas valide ou aucun fichier n'a été choisi.";
                        break;
                    case "productSizeError":
                        $type = "danger";
                        $message = "La taille du fichier est trop grande.";
                        break;
                    case "productFileError":
                        $type = "danger";
                        $message = "Une erreur est survenue pendant l'upload du fichier.";
                        break;
                }
                echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' .
                    $message .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }

            // Supprime le message après avoir affiché l'alert.
            unset($_SESSION['message']);
            ?>

            <nav class="col-sm-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Ajouter un produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recap.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <span class="badge bg-danger">
                                <?php echo isset($_SESSION['products']) ? count($_SESSION['products']) : 0 ?>
                            </span>
                            Récapitulatif
                        </a>
                    </li>
                </ul>
            </nav>

            <?= $contenu ?>

        </div>
    </div>
    <script>
        $(".alert").alert('close')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
