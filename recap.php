<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <title>Récapitulatif des produits</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-2">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Ajouter un produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Récapitulatif</a>
                    </li>
                </ul>
            </nav>
            <article class="col-sm-6">
                <h1>Récapitulatif</h1>
                <?php
                if (!isset($_SESSION['products']) || empty($_SESSION['products'])) { // Si la clé products n'existe pas en session ou qu'elle existe mais est vide...
                    echo "<p>Aucun produit en session...</p>>";
                } else { // Sinon, la clé existe et n'est pas vide. On l'affiche dans un tableau
                    echo '
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>';
                    $totalGeneral = 0;
                    foreach ($_SESSION['products'] as $index => $product) {
                        echo "
                            <tr>
                                <td>" . $index . "</td>
                                <td>" . $product["name"] . "</td>
                                <td>" . number_format($product["price"], 2, ",", "&nbsp;") . "&nbsp;€</td>
                                <td>" . $product["qtt"] . "</td>
                                <td>" . number_format($product["total"], 2, ",", "&nbsp;") . "&nbsp;€</td>
                            </tr>";
                        $totalGeneral += $product["total"];
                    }
                    echo "
                                <tr>
                                    <td colspan=4>Total général : </td>
                                    <td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>
                                </tbody>
                            </table>";
                }
                ?>
            </article>
            <div class="col-sm-2">
                <span class="badge bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <?php echo count($_SESSION['products']) ?> articles
                </span>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>