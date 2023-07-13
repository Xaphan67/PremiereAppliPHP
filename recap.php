<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Récapitulatif des produits</title>
</head>

<body>
    <?php
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) { // Si la clé products n'existe pas en session ou qu'elle existe mais est vide...
        echo "<p>Aucun produit en session...</p>>";
    } else { // Sinon, la clé existe et n'est pas vide. On l'affiche dans un tableau
        echo "
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($_SESSION['products'] as $index => $product) {
            echo "
                <tr>
                    <td>" . $index . "</td>
                    <td>" . $product["name"] . "</td>
                    <td>" . number_format($product["price"], 2, ",", "&nbsp;") . "&nbsp;€</td>
                    <td>" . $product["qtt"] . "</td>
                    <td>" . number_format($product["total"], 2, ",", "&nbsp;") . "&nbsp;€</td>
                </tr>";
        }
        echo "
                </tbody>
            </table>";
    }
    ?>
</body>

</html>