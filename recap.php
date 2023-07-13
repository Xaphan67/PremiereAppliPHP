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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>