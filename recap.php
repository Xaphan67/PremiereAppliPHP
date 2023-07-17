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
    <div class="container">
        <div class="row">
            <nav class="col-sm-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Ajouter un produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
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
            <article class="col-sm-9">
                <h1>Récapitulatif</h1>
                <?php
                if (!isset($_SESSION['products']) || empty($_SESSION['products'])) { // Si la clé products n'existe pas en session ou qu'elle existe mais est vide...
                    echo "<p>Aucun produit en session...</p>";
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
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>';
                    $totalGeneral = 0;
                    foreach ($_SESSION['products'] as $index => $product) {
                        $result = "
                            <tr>
                                <td>" . $index . "</td>
                                <td>" . $product["name"] . "</td>
                                <td>" . number_format($product["price"], 2, ",", "&nbsp;") . "&nbsp;€</td>
                                <td>";

                        $btn = '<a href="traitement.php?action=qttDown&id=' . $index . '"><button type="button" class="btn btn-primary btn-sm">-</button></a>';
                        if ($product["qtt"] <= 1) {
                            $btn = '<button type="button" class="btn btn-secondary btn-sm">-</button>';
                        }

                        $result .= $btn . " " . $product["qtt"] . ' <a href="traitement.php?action=qttUp&id=' . $index . '"><button type="button" class="btn btn-primary btn-sm">+</button></a></td>
                                <td>' . number_format($product["total"], 2, ",", "&nbsp;") . '&nbsp;€</td>
                                <td>
                                    <a href="traitement.php?action=delete-id&id=' . $index . '">
                                        <button type="button" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                            </svg>
                                        </button>
                                    </a>
                                </td>
                            </tr>';
                        $totalGeneral += $product["total"];
                        echo $result;
                    }
                    echo "
                                <tr>
                                    <td colspan=4>Total général : </td>
                                    <td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . '&nbsp;€</strong></td>
                                    <td>
                                    <a href="traitement.php?action=delete">
                                        <button type="button" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                            </svg>
                                            Supprimer tout
                                        </button>
                                    </a>
                                </tbody>
                            </table>';
                }
                ?>
            </article>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>