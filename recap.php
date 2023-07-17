<?php
session_start();
ob_start();
?>

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

<?php
$title = "Récapitulatif";
$contenu = ob_get_clean();
require_once("template.php");
