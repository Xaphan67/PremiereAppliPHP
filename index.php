<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <title>Ajout produit</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-2">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Ajouter un produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recap.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <span class="badge bg-danger">
                                <?php echo count($_SESSION['products']) ?>
                            </span>
                            Récapitulatif
                        </a>
                    </li>
                </ul>
            </nav>
            <article class="col-sm-6">
                <h1>Ajouter un produit</h1>
                <form action="traitement.php?action=add" method="post">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label col-form-label" for="name">Nom du produit :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label col-form-label" for="price">Prix du produit :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" step="any" id="price" name="price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label col-form-label" for="qtt">Quantité désirée :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="qtt" id="qtt" value="1">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Ajouter le produit</button>
                </form>
            </article>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>